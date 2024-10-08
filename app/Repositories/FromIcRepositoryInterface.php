<?php

namespace App\Repositories;

use App\Models\File;
use Illuminate\Http\UploadedFile;

interface FromIcRepositoryInterface
{
    public function IcFile(UploadedFile $file, string $type, string $Id1c): File;
}
