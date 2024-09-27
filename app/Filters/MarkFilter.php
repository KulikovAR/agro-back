<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class MarkFilter extends AbstractFilter
{
    public const CREATED_AT = 'created_at';

    public const ESTIMATION = 'estimation';

    protected function getCallbacks(): array
    {
        return [
            self::CREATED_AT => [$this, 'created_at'],
            self::ESTIMATION => [$this, 'estimation'],
        ];
    }

    public function created_at(Builder $builder, $value)
    {
        $builder->orderBy('created_at', $value);
    }

    public function estimation(Builder $builder, $value)
    {
        $builder->orderBy('estimation', $value);
    }
}
