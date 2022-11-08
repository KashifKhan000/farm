<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Builder;

class QueryLimitHelper
{
    /**
     * @param  mixed  $query
     * @param  int  $limit
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function handle($query, int $limit)
    {
        return $query->limit($limit);
    }
}
