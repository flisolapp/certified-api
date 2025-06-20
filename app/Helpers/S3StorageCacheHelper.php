<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class S3StorageCacheHelper
{

    private static array $cache = [];

    public static function getFile(string $key): ?string
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
