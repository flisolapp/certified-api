<?php

namespace App\Http\Controllers;

use App\Helpers\CertificateHelper;
use App\Helpers\ColorHelper;
use App\Models\PeopleCertificate;
use DateTime;
use DateTimeImmutable;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;

class CertificatesDownloadController extends Controller
{

    public function execute(string $code): StreamedResponse|JsonResponse
    {
        $this->removeMemoryAndTimeLimits();

        $certificate = PeopleCertificate::with(['edition', 'talk'])->where('code', $code)
            ->whereNull('removed_at')
            ->first();

        if (!$certificate || !$certificate->edition) {
            return response()->json(['found' => false], 404);
        }

        $edition = $certificate->edition;
        $certificateOptions = $edition->options->certificate ?? null;
        $editionDir = config('certificates.uploads.edition');
        $editionId = $edition->id;
        $name = $certificate->name;
        $codeVerificationUrl = 'https://certified.flisol.app/' . $certificate->code;

        $font = implode(DIRECTORY_SEPARATOR, [$editionDir, $editionId, $certificateOptions->font ?? 'NunitoSans-Bold.ttf']);

        [$certificateFile, $colorHex] = $this->resolveCertificateTemplate($certificate, $certificateOptions, $editionDir, $editionId);

        if (!$certificateFile || !file_exists($certificateFile)) {
            return response()->json(['found' => false], 404);
        }

        $image = @imagecreatefrompng($certificateFile);

        if ($name) {
            // Draw shadow
            // $shadow = imagecolorallocate($image, 240, 240, 240);
            // imagefttext($image, 60, 0, 109, 471, $shadow, $font, $name);
            [$firstLine, $secondLine] = $this->splitTextBySpace($name, 23);

            // Draw shadow for the first line
            $shadow = imagecolorallocate($image, 240, 240, 240);
            imagefttext($image, 60, 0, 109, 471, $shadow, $font, $firstLine);

            // Draw shadow for the second line, if it exists
            if ($secondLine) {
                imagefttext($image, 60, 0, 109, 551, $shadow, $font, $secondLine);
            }

            // Draw name
            $rgb = ColorHelper::hexToRgb($colorHex);
            $nameColor = imagecolorallocate($image, $rgb->red, $rgb->green, $rgb->blue);
            // imagefttext($image, 60, 0, 108, 470, $nameColor, $font, $name);
            [$firstLine, $secondLine] = $this->splitTextBySpace($name, 23);

            // Draw the first line
            imagefttext($image, 60, 0, 108, 470, $nameColor, $font, $firstLine);

            // Draw the second line, if it exists
            if ($secondLine) {
                imagefttext($image, 60, 0, 108, 550, $nameColor, $font, $secondLine);
            }
        }

        // Talk title if applicable
        if ($certificate->talk) {
            $title = $certificate->talk->title;
            $titleColor = imagecolorallocate($image, 74, 79, 82);
            imagefttext($image, 18, 0, 114, 570, $titleColor, $font, $title);
        }

        // Extra elements
        if ($certificate->federal_code) {
            CertificateHelper::addFederalCode($image, 'CPF', $certificate->federal_code, 12, 23);
        }

        CertificateHelper::addCodeVerificationUrl($image, $codeVerificationUrl, 1586, 0);
        CertificateHelper::addQrCode($image, $codeVerificationUrl, 1280, 780);

        $data = CertificateHelper::getData($image);

        // Update last view
        $certificate->last_view_at = DateTimeImmutable::createFromMutable(new DateTime());
        $certificate->save();

        return Response::streamDownload(function () use ($data) {
            echo $data;
        }, 'certificate_' . $certificate->code . '.png', [
            'Content-Type' => 'image/png',
        ]);
    }

    private function removeMemoryAndTimeLimits(): void
    {
        ini_set('memory_limit', '-1');
        set_time_limit(0);
    }

    private function resolveCertificateTemplate(object $certificate, object $certificateOptions, string $editionDir, string $editionId): array
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

                return [
                    implode(DIRECTORY_SEPARATOR, [$editionDir, $editionId, $option->file]),
                    $option->color
                ];
            }
        }

        return [null, $defaultColor];
    }

    private function splitTextBySpace(string $text, int $near): array
    {
        if (mb_strlen($text) <= $near) {
            return [$text, null];
        }

        // Find space before or after the target length
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
