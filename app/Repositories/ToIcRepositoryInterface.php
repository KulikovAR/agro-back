<?php

namespace App\Repositories;

use App\Models\File;
use Illuminate\Http\UploadedFile;

interface ToIcRepositoryInterface
{
    public function loadFileToIc(string $file, string $fileName, string $fileId): int;

}
