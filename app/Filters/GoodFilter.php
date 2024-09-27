<?php

namespace App\Filters;

use App\Filters\Hanlders\Goods\ParameterHandler;
use Illuminate\Database\Eloquent\Builder;

class GoodFilter extends AbstractFilter
{
    public const PRICE = 'price';

    public const PRICE_OLD = 'price_old';

    public const CATEGORY = 'category';

    public const OVERALL_RATING = 'overall_rating';

    public const PRICE_TO = 'price_to';

    public const PRICE_FROM = 'price_from';

    public const SUBCATEGORY = 'subcategory';

    public const PARAM_VALUES = 'param_values';

    public const ATTRIBUTES = 'attributes';

    public const FAVORITES = 'favorites';

    protected function getCallbacks(): array
    {
        return [
            self::PRICE => [$this, 'price'],
            self::PRICE_OLD => [$this, 'price_old'],
            self::PRICE_FROM => [$this, 'price_from'],
            self::PRICE_TO => [$this, 'price_to'],
            self::CATEGORY => [$this, 'category'],
            self::OVERALL_RATING => [$this, 'overall_rating'],
            self::SUBCATEGORY => [$this, 'subcategory'],
            self::PARAM_VALUES => [$this, 'param_values'],
            self::ATTRIBUTES => [$this, 'attributes'],
            self::FAVORITES => [$this, 'favorites'],
        ];
    }

    public function favorites(Builder $builder, $value)
    {

        $builder->whereHas('favorites', function ($q) use ($value) {
            $q->where('user_id', $value);
        });
    }

    public function category(Builder $builder, $value)
    {
        $builder->WhereHas('tags', function ($q) use ($value) {
            $q->where('id', $value);
        });
    }

    public function subcategory(Builder $builder, $value)
    {
        $builder->WhereHas('tags.subcategories', function ($q) use ($value) {
            $q->where('id', $value);
        });
    }

    public function param_values(Builder $builder, $value)
    {
        $builder->WhereHas('paramValues', function ($q) use ($value) {
            $q->whereIn('param_value_id', $value);
        });
    }

    public function attributes(Builder $builder, $value)
    {
        $parameter_handler = new ParameterHandler;
        $builder = $parameter_handler->handler($builder, $value);
    }

    public function price_to(Builder $builder, $value)
    {
        $builder->where('price', '<=', $value);
    }

    public function price_from(Builder $builder, $value)
    {
        $builder->where('price', '>=', $value);
    }

    public function overall_rating(Builder $builder, $value)
    {
        $builder->withAvg('marks', 'estimation')->orderBy('marks_avg_estimation', $value);
    }
}
