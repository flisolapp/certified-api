<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use RuntimeException;
use Throwable;

class CertificateStorageCacheHelper
{

    private static array $cache = [];

    /**
     * Retrieves the local file path for a certificate PNG.
     *
     * If the file exists locally, returns the cached path.
     * If not, attempts to download from S3.
     * Returns null if the file does not exist in either location.
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

        $diskS3 = Storage::disk('s3');
        $diskLocal = Storage::disk('storage_cache');

        $s3Key = "certificates/{$editionId}/{$code}.png";
        $localPath = "certificates/{$editionId}/{$code}.png";

        // Check local cache
        if ($diskLocal->exists($localPath)) {
            return self::$cache[$code] = $diskLocal->path($localPath);
        }

        // Try downloading from S3
        try {
            if ($diskS3->exists($s3Key)) {
                $binaryContent = $diskS3->get($s3Key);
                $diskLocal->put($localPath, $binaryContent);
                return self::$cache[$code] = $diskLocal->path($localPath);
            }
        } catch (Throwable $e) {
            Log::error("S3 get failed for '{$s3Key}': " . $e->getMessage());
        }

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
