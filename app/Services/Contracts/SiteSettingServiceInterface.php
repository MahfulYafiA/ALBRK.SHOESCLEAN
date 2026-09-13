<?php

namespace App\Services\Contracts;

use Illuminate\Http\UploadedFile;

interface SiteSettingServiceInterface
{
    public function updateImage(string $key, string $prefix, UploadedFile $file): array;
}
