<?php

namespace App\Repositories;

interface FromIcRepositoryInterface
{
    public function loadFileToIc(string $file, string $filename): int;
}
