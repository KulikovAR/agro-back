<?php


namespace App\Filters;


use App\Filters\Hanlders\Goods\ParameterHandler;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;

class GoodFilter extends AbstractFilter
{
    public const NAME = 'name';
    public const CLASS = 'class';
    public const ATTR = 'attr';
    public const COMPANY = 'company';
    public const PRICE = 'price';
    public const GLUTEN = 'gluten';
    public const IDK = 'idk';
    public const CHP = 'chp';
    public const NATURE  = 'nature';
    public const HUMIDITY = 'humidity';
    public const WEED_IMPURITY = 'weed_impurity';
    public const CHINCH = 'chinch';
    public const EXPORTER = 'exporter';




    protected function getCallbacks(): array
    {
        return [
            self::NAME                     => [$this, 'name'],
            self::CLASS                    => [$this, 'CLASS'],
            self::ATTR                     => [$this, 'attr'],
            self::COMPANY                  => [$this, 'company'],
            self::PRICE                    => [$this, 'price'],
            self::GLUTEN                   => [$this, 'gluten'],
            self::IDK                      => [$this, 'idk'],
            self::CHP                      => [$this, 'chp'],
            self::NATURE                   => [$this, 'nature'],
            self::HUMIDITY                 => [$this, 'humidity'],
            self::WEED_IMPURITY            => [$this, 'weed_impurity'],
            self::CHINCH                   => [$this, 'chinch'],
            self::EXPORTER                 => [$this, 'exporter'],
        ];
    }

    public function name(Builder $builder, $value)
    {

        $builder->whereIn('name', $value);
    }

    public function attr(Builder $builder, $value)
    {
        $builder->whereIn('attr', $value);
    }
    public function class(Builder $builder, $value)
    {
        $builder->whereIn('class', $value);
    }
    public function idk(Builder $builder, $value)
    {
        $builder->whereIn('idk', $value);
    }
    public function chp(Builder $builder, $value)
    {
        $builder->whereIn('chp', $value);
    }
    public function nature(Builder $builder, $value)
    {
        $builder->whereIn('nature', $value);
    }
    public function humidity(Builder $builder, $value)
    {
        $builder->whereIn('humidity', $value);
    }
    public function gluten(Builder $builder, $value)
    {
        $builder->whereIn('gluten', $value);
    }
    public function weed_impurity(Builder $builder, $value)
    {
        $builder->whereIn('weed_impurity', $value);
    }
    public function exporter(Builder $builder, $value)
    {
        $builder->whereIn('exporter', $value);
    }
    public function chinch(Builder $builder, $value)
    {
        $builder->whereIn('chinch', $value);
    }
}
