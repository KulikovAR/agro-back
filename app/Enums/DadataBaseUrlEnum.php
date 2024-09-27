<?php

namespace App\Enums;

enum DadataBaseUrlEnum: string
{
    case SUGGEST = 'suggest/address';
    case GEOLOCATE = 'geolocate/address';
    case CLIENT = 'suggest/party';
    case FIND_BY_INN = 'findById/party';
}
