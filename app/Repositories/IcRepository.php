<?php

namespace App\Repositories;

use App\Clients\IcClient;
use App\Models\File;
use App\Traits\FileTrait;
use Illuminate\Http\UploadedFile;

class IcRepository
{
    use FileTrait;

    public function __construct(
        private $client,
    )
    {
        $this->client = new IcClient();
    }

    public function IcFile(UploadedFile $file, string $IcId): File
    {
        $fileFromIc = $this->loadFile($file);
        $fileFromIc->update(['1c_id' => $IcId]);
        return $fileFromIc;
    }
}
