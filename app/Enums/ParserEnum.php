<?php

namespace App\Enums;

enum ParserEnum: string
{
    case GLUTEN          = 'клейковина';
    case IDK             = 'ИДК';
    case chp             = 'чп';
    case NATURE          = 'натура';
    case HUMIDITY        = 'humidity';
    case WEED_IMPURITY   = 'сорная примесь';
    case CHINCH          = 'клоп';
    case EXPORTER        = 'ООО "ТД "РИФ"';


}