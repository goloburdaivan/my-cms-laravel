<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ImageStorageService
{
    public function upload(string $disk, string $folder, UploadedFile $file): string
    {
        return Storage::disk($disk)->putFile($folder, $file);
    }
}
