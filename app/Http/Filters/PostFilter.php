<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class PostFilter extends AbstractFilter
{
    public const TITLE = 'title';

    protected function getCallbacks(): array
    {
        return [
            self::TITLE => [$this, 'title'],
        ];
    }

    public function title(Builder $builder, $value)
    {
        $builder->where(DB::raw('LOWER(' . self::TITLE . ')'), 'like', strtolower("%{$value}%"));
    }
}
