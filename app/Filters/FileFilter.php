<?php

namespace App\Filters;

use App\Models\File;
use Illuminate\Database\Eloquent\Builder;

class FileFilter extends AbstractFilter
{
    public const TYPE = 'type';

    public const SORT = 'sort';

    protected function getCallbacks(): array
    {
        return [
            self::TYPE => [$this, 'type'],
            self::SORT => [$this, 'sort'],
        ];
    }

    public function type(Builder $builder, $value)
    {
        $builder->where('type', $value);
    }

    public function sort(Builder $builder, $value)
    {
        $sortType = substr($value, 0, 1) == '-' ? 'desc' : 'asc';

        $field = trim($value, '-');

        if (! in_array($field, File::sortFields())) {
            return;
        }

        $builder->orderBy($field, $sortType);
    }
}
