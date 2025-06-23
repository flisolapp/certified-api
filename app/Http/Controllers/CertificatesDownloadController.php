<?php

namespace App\Http\Controllers;

use App\Helpers\CertificateHelper;
use App\Helpers\ColorHelper;
use App\Helpers\StorageCacheHelper;
use App\Models\PeopleCertificate;
use DateTime;
use DateTimeImmutable;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;

class CertificatesDownloadController extends Controller
{

    /**
     * Main execution method to generate and download the certificate as PNG.
     *
     * @param string $code Unique certificate code for validation.
     * @return StreamedResponse|JsonResponse
     */
    public function execute(string $code): StreamedResponse|JsonResponse
    {
        // Remove PHP time and memory limits for large image processing
        $this->removeMemoryAndTimeLimits();

        // Retrieve certificate with edition and talk relationships
        $certificate = PeopleCertificate::with(['edition', 'talk'])
            ->where('code', $code)
            ->whereNull('removed_at')
            ->first();

        // If certificate or edition not found, return 404
        if (!$certificate || !$certificate->edition) {
            return response()->json(['found' => false], 404);
        }

        $edition = $certificate->edition;
        $certificateOptions = $edition->options->certificate ?? null;
        $editionId = $edition->id;
        $name = $certificate->name;
        $codeVerificationUrl = 'https://certified.flisol.app/' . $certificate->code;

        // Cache check
        $cachedCertificate = StorageCacheHelper::get("certificates/{$editionId}/{$certificate->code}.png");

        if ($cachedCertificate && file_exists($cachedCertificate)) {
            return Response::streamDownload(function () use ($cachedCertificate) {
                readfile($cachedCertificate);
            }, 'certificate_' . $certificate->code . '.png', [
                'Content-Type' => 'image/png',
            ]);
        }

        // If not exists on cache

        // Load and cache font from S3 (stored per edition)
        $fontFileName = $certificateOptions->font ?? 'NunitoSans-Bold.ttf';
        $fontKey = "editions/{$editionId}/{$fontFileName}";
        $font = StorageCacheHelper::get($fontKey);

        // Abort if font file was not found
        if (!$font || !file_exists($font)) {
            return response()->json(['found' => false, 'error' => 'Font not found'], 404);
        }

        // Resolve the certificate background image (template) and text color
        [$certificateFile, $colorHex] = $this->resolveCertificateTemplate($certificate, $certificateOptions, $editionId);

        // Abort if template was not found
        if (!$certificateFile || !file_exists($certificateFile)) {
            return response()->json(['found' => false, 'error' => 'Template not found'], 404);
        }

        // Load the PNG certificate template image
        $image = @imagecreatefrompng($certificateFile);

        // Draw participant name (with optional second line if too long)
        if ($name) {
            [$firstLine, $secondLine] = $this->splitTextBySpace($name, 23);

            // Draw shadow (light gray) behind the text for better visibility
            $shadow = imagecolorallocate($image, 240, 240, 240);
            imagefttext($image, 60, 0, 109, 471, $shadow, $font, $firstLine);
            if ($secondLine) {
                imagefttext($image, 60, 0, 109, 551, $shadow, $font, $secondLine);
            }

            // Draw actual participant name (colored)
            $rgb = ColorHelper::hexToRgb($colorHex);
            $nameColor = imagecolorallocate($image, $rgb->red, $rgb->green, $rgb->blue);
            imagefttext($image, 60, 0, 108, 470, $nameColor, $font, $firstLine);
            if ($secondLine) {
                imagefttext($image, 60, 0, 108, 550, $nameColor, $font, $secondLine);
            }
        }

        // Draw talk title if this certificate is linked to a talk
        if ($certificate->talk) {
            $title = $certificate->talk->title;
            $titleColor = imagecolorallocate($image, 74, 79, 82);
            imagefttext($image, 18, 0, 114, 620, $titleColor, $font, $title);
        }

        // Optional: Draw CPF if available
        if ($certificate->federal_code) {
            CertificateHelper::addFederalCode($image, 'CPF', $certificate->federal_code, 12, 23);
        }

        // Add code verification URL and QR code to the certificate
        CertificateHelper::addCodeVerificationUrl($image, $codeVerificationUrl, 1586, 0);
        CertificateHelper::addQrCode($image, $codeVerificationUrl, 1280, 780);

        // Convert the image to binary PNG data
        $data = CertificateHelper::getData($image);

        if ($data === null) {
            return response()->json(['found' => false, 'error' => 'Image generation failed'], 500);
        }

        // Update the 'last_view_at' timestamp
        $certificate->last_view_at = DateTimeImmutable::createFromMutable(new DateTime());
        $certificate->save();

        // Cache the generated certificate
        StorageCacheHelper::save("certificates/{$editionId}/{$certificate->code}.png", $data);

        // Stream the image as a download response
        return Response::streamDownload(function () use ($data) {
            echo $data;
        }, 'certificate_' . $certificate->code . '.png', [
            'Content-Type' => 'image/png',
        ]);
    }

    /**
     * Remove PHP time and memory limits for large image generation.
     */
    private function removeMemoryAndTimeLimits(): void
    {
        ini_set('memory_limit', '-1');
        set_time_limit(0);
    }

    /**
     * Resolve the correct certificate template (PNG) and text color based on the certificate type.
     *
     * Priority order:
     * Organizer > Collaborator > Talk (Speaker) > Participant
     *
     * @param object $certificate
     * @param object|null $certificateOptions
     * @param string $editionId
     * @return array [file path, hex color]
     */
    private function resolveCertificateTemplate(object $certificate, ?object $certificateOptions, string $editionId): array
    {
        $defaultColor = '#FE8200';

        $types = [
            'organizer' => 'organizer',
            'collaborator' => 'collaborator',
            'talk' => 'speaker',
            'participant' => 'participant'
        ];

        foreach ($types as $property => $optionKey) {
            if ($certificate->$property && isset($certificateOptions->$optionKey)) {
                $option = $certificateOptions->$optionKey;

                // Load template file from S3 and cache locally
                $fileKey = "editions/{$editionId}/{$option->file}";
                $file = StorageCacheHelper::get($fileKey);

                return [$file, $option->color];
            }
        }

        return [null, $defaultColor];
    }

    /**
     * Splits a long name into two lines, breaking at the nearest space close to the desired length.
     *
     * @param string $text The original text to split.
     * @param int $near Preferred max length for the first line.
     * @return array [firstLine, secondLine|null]
     */
    private function splitTextBySpace(string $text, int $near): array
    {
        if (mb_strlen($text) <= $near) {
            return [$text, null];
        }

        $before = mb_strrpos(mb_substr($text, 0, $near + 1), ' ');
        $after = mb_strpos($text, ' ', $near);

        if ($before === false && $after === false) {
            return [$text, null];
        }

        $splitPos = $before !== false ? $before : $after;
        $firstLine = trim(mb_substr($text, 0, $splitPos));
        $secondLine = trim(mb_substr($text, $splitPos));

        return [$firstLine, $secondLine];
    }

}
