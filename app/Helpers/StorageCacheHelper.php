<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class StorageCacheHelper
{

    private static array $cache = [];

    public static function getFileFromS3(string $key): ?string
    {
        if (isset(self::$cache[$key])) {
            return self::$cache[$key];
        }

        $disk = Storage::disk('s3');
        $localDisk = Storage::disk('local');

        $localPath = "cache/{$key}";

        if (!$localDisk->exists($localPath)) {
            if (!Storage::disk('s3')->exists($key)) {
                return null;
            }

            $localDisk->put($localPath, $disk->get($key));
        }

        self::$cache[$key] = $localDisk->path($localPath);

        return self::$cache[$key];
    }

}
