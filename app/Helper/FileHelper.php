<?php

namespace App\Helper;

use Illuminate\Support\Facades\Storage;

class FileHelper
{
    public static function uplodFiles($files, $path)
    {
        $fileResult = [];
        foreach ($files as $file)
            $f = self::uplodFile($file, $path);
        array_push($fileResult, $f);
        return $fileResult;
    }

    public static function uplodFile($file, $path)
    {
        return Storage::putFile($path, $file);
    }
}
