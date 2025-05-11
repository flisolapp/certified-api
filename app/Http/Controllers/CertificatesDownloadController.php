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

        // Draw shadow
        $shadow = imagecolorallocate($image, 240, 240, 240);
        imagefttext($image, 60, 0, 109, 471, $shadow, $font, $name);

        // Draw name
        $rgb = ColorHelper::hexToRgb($colorHex);
        $nameColor = imagecolorallocate($image, $rgb->red, $rgb->green, $rgb->blue);
        imagefttext($image, 60, 0, 108, 470, $nameColor, $font, $name);

        // Talk title if applicable
        if ($certificate->talk && !$certificate->name_only) {
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

        if ($certificate->organizer && isset($certificateOptions->organizer)) {
            return [
                implode(DIRECTORY_SEPARATOR, [$editionDir, $editionId, $certificateOptions->organizer->file]),
                $certificateOptions->organizer->color
            ];
        }

        if ($certificate->collaborator && isset($certificateOptions->collaborator)) {
            return [
                implode(DIRECTORY_SEPARATOR, [$editionDir, $editionId, $certificateOptions->collaborator->file]),
                $certificateOptions->collaborator->color
            ];
        }

        if ($certificate->talk && isset($certificateOptions->speaker)) {
            $isNameOnly = $certificate->name_only ?? false;
            $options = $isNameOnly ? ($certificateOptions->speaker_name_only ?? null) : $certificateOptions->speaker;

            if ($options) {
                return [
                    implode(DIRECTORY_SEPARATOR, [$editionDir, $editionId, $options->file]),
                    $options->color
                ];
            }
        }

        if ($certificate->participant && isset($certificateOptions->participant)) {
            return [
                implode(DIRECTORY_SEPARATOR, [$editionDir, $editionId, $certificateOptions->participant->file]),
                $certificateOptions->participant->color
            ];
        }

        return [null, $defaultColor];
    }
}
