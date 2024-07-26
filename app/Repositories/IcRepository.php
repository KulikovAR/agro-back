<?php

namespace App\Repositories;

use App\Clients\IcClient;
use App\Models\File;
use App\Services\ProductParser\Client\RifClient;
use App\Traits\FileTrait;
use Illuminate\Http\UploadedFile;

class IcRepository
{
    use FileTrait;

    public function __construct(
        private IcClient $client = new IcClient(),
    )
    {
    }

    public function IcFile(string $file, string $type,string $Id1c): File
    {
        $fileFromIc = $this->loadFileInBase64($file,$type,$Id1c);
        return $fileFromIc;
    }
}
