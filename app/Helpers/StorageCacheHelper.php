<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use RuntimeException;
use Throwable;

class StorageCacheHelper
{

    private static array $cache = [];

    public static function get(string $key): ?string
    {
        if (isset(self::$cache[$key])) {
            return self::$cache[$key];
        }

        $disk = Storage::disk('s3');
        $localDisk = Storage::disk('storage_cache');

        // Try downloading from S3
        try {
            if (!$localDisk->exists($key)) {
                if (!Storage::disk('s3')->exists($key)) {
                    return null;
                }

                $localDisk->put($key, $disk->get($key));
            }
        } catch (Throwable $e) {
            Log::error("S3 get failed for '{$key}': " . $e->getMessage());
        }

        self::$cache[$key] = $localDisk->path($key);

        return self::$cache[$key];
    }

    public static function save(string $key, string $binaryData): void
    {
        if ($binaryData === null) {
            throw new RuntimeException("Cannot save null data for key: {$key}");
        }

        $diskS3 = Storage::disk('s3');
        $diskLocal = Storage::disk('storage_cache');

        $diskLocal->put($key, $binaryData);
        $diskS3->put($key, $binaryData);

        self::$cache[$key] = $diskLocal->path($key);
    }

}
