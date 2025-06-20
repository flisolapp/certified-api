<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Throwable;

class StorageCacheHelper
{

    private static array $cache = [];

    public static function getFileFromS3(string $key): ?string
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

}
