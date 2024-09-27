<?php

namespace App\Repositories;

interface ToIcRepositoryInterface
{
    public function loadFileToIc(string $file, string $fileName, string $fileId): int;
}
