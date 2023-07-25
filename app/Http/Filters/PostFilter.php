<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class PostFilter extends AbstractFilter
{
    public const TITLE = 'title';

    public const SORT = 'sort';

    protected function getCallbacks(): array
    {
        return [
            self::TITLE => [$this, 'title'],
            self::SORT => [$this, 'sort'],
        ];
    }

    public function title(Builder $builder, $value)
    {
        $builder->where(DB::raw('LOWER(' . self::TITLE . ')'), 'like', strtolower("%{$value}%"));
    }

    public function sort(Builder $builder, $value)
    {
        $dir = str_contains($value, 'desc') ? 'desc' : 'asc';
        $value = str_replace(',desc', '', $value);
        $column = str_replace('date', 'updated_at', $value);

        switch ($column) {
            case 'views':
                $builder->leftJoin('post_views', 'posts.id', '=', 'post_views.post_id')
                    ->select('posts.*', 'post_views.count as view_count')
                    ->orderBy('view_count', $dir);
                break;
            case 'updated_at':
            case 'title':
                $builder->orderBy($column, $dir);
                break;
        }
    }
}
