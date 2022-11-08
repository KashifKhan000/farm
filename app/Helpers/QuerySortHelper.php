<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Builder;

class QuerySortHelper
{
    const ASC   = 'asc';
    const DESC  = 'desc';

    /**
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  array  $sort
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function handle($query, array $sort)
    {
        foreach ($sort as $column => $direction) {
            $query = $query->orderBy($column, $direction);
        }

        return $query;
    }
}
