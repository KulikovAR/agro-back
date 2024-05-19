<?php

namespace App\Enums;

enum CropOrderEnum: string
{
    case BARLEY = 'Ячмень';
    case WHEAT = 'Пшеница';
    case WHEAT_3_CLASS = 'Пшеница 3-кл';
    case WHEAT_4_CLASS = 'Пшеница 4-кл';
    case WHEAT_5_CLASS = 'Пшеница 5-кл';
    case CORN = 'Кукуруза';
    case PEAS = 'Горох';
    case FLAX = 'Лен';
    case CHICKPEAS = 'Нут';
    case SUNFLOWER = 'Подсолнечник';
    case OATS = 'Овес';
    case RAPE = 'Рапс';
    case SAFFLOWER = 'Сафлор';
    case SORGHUM = 'Сорго';
    case SOY = 'Соя';
    case LENTILS = 'Чечевица';
    case CAKE = 'Жмых';
    case POMACE = 'Жом';
    case GRANULATED_POMACE = 'Жом гранулированный';
    case MUSTARD = 'Горчица';
    case BARD = 'Барда';
    case TRITICALE = 'Тритикале';
    case LUPINE = 'Люпин';
    case GRANULATED_BRAN = 'Отруби гранулированные';
    case FLUFFY_WHEAT_BRAN = 'Отруби пшеничные пушистые';
    case CORN_GLUTEN_FEED = 'Корм кукурузный глютеновый';
    case MEAL = 'Шрот';
    case CORN_GERM = 'Кукурузный зародыш';
    case SUNFLOWER_HUSK = 'Лузга подсолнечника';
    case SUNFLOWER_OIL = 'Масло подсолнечное';
    case MILLET = 'Просо';
    case RICE = 'Рис';
    case RYE = 'Рожь';
    case NUTS = 'Орехи ШИ';
    case BEET = 'Свекла';
    case APPLES = 'Яблоки';
    case SEEDS = 'Семена';
    case BUCKWHEAT = 'Рыжик';
    case COAL = 'Уголь';
    case METAL = 'Металл';
    case SAND = 'Песок';
    case CRUSHED_STONE = 'Щебень';
    case FERTILIZERS = 'Удобрения';
    case AMMONIUM_NITROPHOSPHATE = 'Нитроаммофоска';
    case SALTPETER = 'Селитра';
    case AMMONIUM_PHOSPHATE = 'Аммофос';

    public static function getCrop(): array
    {
        return [
            self::BARLEY->value,
            self::WHEAT->value,
            self::WHEAT_3_CLASS->value,
            self::WHEAT_4_CLASS->value,
            self::WHEAT_5_CLASS->value,
            self::CORN->value,
            self::PEAS->value,
            self::FLAX->value,
            self::CHICKPEAS->value,
            self::SUNFLOWER->value,
            self::OATS->value,
            self::RAPE->value,
            self::SAFFLOWER->value,
            self::SORGHUM->value,
            self::SOY->value,
            self::LENTILS->value,
            self::MEAL->value,
            self::POMACE->value,
            self::GRANULATED_POMACE->value,
            self::MUSTARD->value,
            self::BARD->value,
            self::TRITICALE->value,
            self::LUPINE->value,
            self::GRANULATED_BRAN->value,
            self::FLUFFY_WHEAT_BRAN->value,
            self::CORN_GLUTEN_FEED->value,
            self::CAKE->value,
            self::CORN_GERM->value,
            self::SUNFLOWER_HUSK->value,
            self::SUNFLOWER_OIL->value,
            self::MILLET->value,
            self::RICE->value,
            self::RYE->value,
            self::NUTS->value,
            self::BEET->value,
            self::APPLES->value,
            self::SEEDS->value,
            self::BUCKWHEAT->value,
            self::COAL->value,
            self::METAL->value,
            self::SAND->value,
            self::CRUSHED_STONE->value,
            self::FERTILIZERS->value,
            self::AMMONIUM_NITROPHOSPHATE->value,
            self::SALTPETER->value,
            self::AMMONIUM_PHOSPHATE->value,
        ];
    }
}
