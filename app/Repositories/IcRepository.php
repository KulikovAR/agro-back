<?php

namespace App\Repositories;

use App\Clients\IcClient;
use App\Models\File;
use App\Services\ProductParser\Client\RifClient;
use App\Traits\FileTrait;
use Illuminate\Http\UploadedFile;

class IcRepository implements ToIcRepositoryInterface, FromIcRepositoryInterface
{
    use FileTrait;

    private $client;
    public function __construct()
    {
        $this->client = new IcClient();
    }

    public function IcFile(UploadedFile $file, string $type,string $Id1c): File
    {
        $fileFromIc = $this->loadFile($file,$type,$Id1c);
        return $fileFromIc;
    }

    public function loadFileToIc(string $file, string $fileName, string $fileId): int
    {
        $query = [
            'file' => $file,
            'filename' => $fileName,
        ];
        $result = $this->client->worker->post(config("1c.url"). $fileId,$query);
        return $result->status();
    }
}
