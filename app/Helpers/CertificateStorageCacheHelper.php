<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use RuntimeException;

class CertificateStorageCacheHelper
{

    private static array $cache = [];

    /**
     * Retrieves the local file path for a certificate PNG.
     *
     * If exists locally, returns the cached path.
     * If not, attempts to download from S3 via StorageCacheHelper.
     * Returns null if not found in either location.
     *
     * @param int $editionId Edition ID used for folder scoping.
     * @param string $code Certificate code.
     * @return string|null Local file path or null if not found.
     */
    public static function getOrDownload(int $editionId, string $code): ?string
    {
        if (isset(self::$cache[$code])) {
            return self::$cache[$code];
        }

        $s3Key = "certificates/{$editionId}/{$code}.png";

        $filePath = StorageCacheHelper::getFileFromS3($s3Key);

        if ($filePath !== null) {
            return self::$cache[$code] = $filePath;
        }

        Log::warning("Certificate file not found in local cache or S3: {$s3Key}");

        return null;
    }

    /**
     * Saves the generated certificate PNG to both local cache and S3.
     *
     * @param int $editionId Edition ID used for folder scoping.
     * @param string $code Certificate code.
     * @param string $binaryData PNG binary content.
     * @return void
     */
    public static function save(int $editionId, string $code, string $binaryData): void
    {
        if ($binaryData === null) {
            throw new RuntimeException("Cannot save null certificate data for code: {$code}");
        }

        $diskS3 = Storage::disk('s3');
        $diskLocal = Storage::disk('storage_cache');

        $s3Key = "certificates/{$editionId}/{$code}.png";
        $localPath = "certificates/{$editionId}/{$code}.png";

        $diskLocal->put($localPath, $binaryData);
        $diskS3->put($s3Key, $binaryData);

        self::$cache[$code] = $diskLocal->path($localPath);
    }

}
