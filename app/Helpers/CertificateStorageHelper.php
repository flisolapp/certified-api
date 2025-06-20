<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;
use RuntimeException;
use Throwable;

class CertificateStorageHelper
{

    private static array $cache = [];

    /**
     * Returns the local path for a certificate image.
     * If not cached locally, downloads from S3 or triggers generation (caller responsibility).
     *
     * @param string $code
     * @return string|null
     */
    public static function getOrDownload(string $code): ?string
    {
        if (isset(self::$cache[$code])) {
            return self::$cache[$code];
        }

        $diskS3 = Storage::disk('s3');
        $diskLocal = Storage::disk('local');

        $s3Key = "certificates/{$code}.png";
        $localPath = "cache/certificates/{$code}.png";

        if ($diskLocal->exists($localPath)) {
            self::$cache[$code] = $diskLocal->path($localPath);
            return self::$cache[$code];
        }

        if ($diskS3->exists($s3Key)) {
            try {
                $diskLocal->put($localPath, $diskS3->get($s3Key));
                self::$cache[$code] = $diskLocal->path($localPath);
                return self::$cache[$code];
            } catch (Throwable $e) {
                // Importante: capture Throwable para pegar Error e Exception
                // \Log::error("Failed to get S3 object '{$s3Key}': " . $e->getMessage());
            }
        }

        return null;
    }

    /**
     * Saves the generated PNG both locally and on S3.
     *
     * @param string $code
     * @param string $binaryData
     * @return void
     */
    public static function save(string $code, string $binaryData): void
    {
        if ($binaryData === null) {
            throw new RuntimeException("Cannot save null certificate data for code: {$code}");
        }

        $diskS3 = Storage::disk('s3');
        $diskLocal = Storage::disk('local');

        $s3Key = "certificates/{$code}.png";
        $localPath = "cache/certificates/{$code}.png";

        $diskLocal->put($localPath, $binaryData);
        $diskS3->put($s3Key, $binaryData);

        self::$cache[$code] = $diskLocal->path($localPath);
    }

}
