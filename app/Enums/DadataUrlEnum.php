<?php

namespace App\Enums;

enum DadataUrlEnum: string
{
    case API_URL_SUGGEST = 'https://suggestions.dadata.ru';
    case API_URL_CLEANER = 'https://cleaner.dadata.ru';
    case API_URL = 'https://suggestions.dadata.ru/suggestions/api/4_1/rs/';
    case API_CLEANER_URL = 'https://cleaner.dadata.ru/api/v1/clean/';
}
