<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

trait FileTrait
{
    public static function uploadFile(UploadedFile $file, string $folder, string $disk = 'public'): string
    {
        // Validate extension and size should be done before calling this helper.
        $filename = $file->getClientOriginalName();

        // store returns path like "folder/filename.ext"
        $path = $file->storeAs($folder, $filename, $disk);

        return $path; // save this path in DB
    }


    public static function deleteFile(string $path, string $disk = 'public'): bool
    {
        if (!$path) return false;
        if (Storage::disk($disk)->exists($path)) {
            return Storage::disk($disk)->delete($path);
        }
        return false;
    }

    public static function updateFile(?UploadedFile $newFile, string $oldPath, string $folder, string $disk = 'public'): ?string
    {
        if (!$newFile) return $oldPath;
        // upload new
        $newPath = self::uploadFile($newFile, $folder, $disk);
        // delete old
        self::deleteFile($oldPath, $disk);
        return $newPath;
    }
}
