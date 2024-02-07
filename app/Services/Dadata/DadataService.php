<?php

namespace App\Services;
use App\Services\Dadata\Dadata;

class LocalizationService
{

    function __construct(
        private Dadata $dadata
    )
    {

    }
    public static function checkInn(): array
    {
        $company = $this->dadata->getInfoByInn();
    }
}
