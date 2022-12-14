<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Builder;

class QueryFilterHelper
{
    const IS        = 'is';
    const IS_NULL   = 'is_null';
    const ISNT      = 'isnt';
    const ISNT_NULL = 'isnt_null';
    const LESS      = 'less';
    const GREATER   = 'greater';
    const MIN       = 'min';
    const MAX       = 'max';

    /**
     * @param  mixed  $query
     * @param  Array  $filter
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function handle($query, Array $filter)
    {
        foreach ($filter as $column => $types) {
            $query = self::processFilter($query, $column, $types);
        }

        return $query;
    }

    /**
     * @param  mixed  query
     * @param  string  $column
     * @param  Array  $types
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected static function processFilter($query, string $column, Array $types)
    {
        $keys = array_keys($types);
        $values = array_values($types);

        $is = in_array(self::IS, $keys);
        $is_null = in_array(self::IS_NULL, $keys);
        $isnt = in_array(self::ISNT, $keys);
        $isnt_null = in_array(self::ISNT_NULL, $keys);
        $less = in_array(self::LESS, $keys);
        $greater = in_array(self::GREATER, $keys);
        $min = in_array(self::MIN, $keys);
        $max = in_array(self::MAX, $keys);

        if ($is || $isnt) {
            if ($is) {
                $query = self::handleIs($query, $column, $values);
            } else {
                $query = self::handleIsnt($query, $column, $values);
            }
        } else if ($is_null || $isnt_null) {
            if ($is_null) {
                $query = self::handleIsNull($query, $column);
            } else {
                $query = self::handleIsntNull($query, $column);
            }
        } else if ($less || $greater) {
            if ($less) {
                $query = self::handleLess($query, $column, $values[0]);
            } else {
                $query = self::handleGreater($query, $column, $values[0]);
            }
        } else {
            if ($min && $max) {
                $query = self::handleBetween($query, $column, $values);
            } else {
                if ($min) {
                    $query = self::handleMin($query, $column, $values[0]);
                } else if ($max) {
                    $query = self::handleMax($query, $column, $values[0]);
                }
            }
        }

        return $query;
    }

    /**
     * @param  mixed  $query
     * @param  string  $column
     * @param  mixed  $value
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected static function handleIs($query, string $column, $value)
    {
        return $query->where($column, '=', $value);
    }

    /**
     * @param  mixed  $query
     * @param  string  $column
     * @param  mixed  $value
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected static function handleIsnt($query, string $column, $value)
    {
        return $query->where($column, '!=', $value);
    }

    /**
     * @param  mixed  $query
     * @param  string  $column
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected static function handleIsNull($query, string $column)
    {
        return $query->whereNull($column);
    }

    /**
     * @param  mixed  $query
     * @param  string  $column
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected static function handleIsntNull($query, string $column)
    {
        return $query->whereNotNull($column);
    }

    /**
     * @param  mixed  $query
     * @param  string  $column
     * @param  mixed  $value
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected static function handleLess($query, string $column, $value)
    {
        return $query->where($column, '>', $value);
    }

    /**
     * @param  mixed  $query
     * @param  string  $column
     * @param  mixed  $value
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected static function handleGreater($query, string $column, $value)
    {
        return $query->where($column, '<', $value);
    }

    /**
     * @param  mixed  $query
     * @param  string  $column
     * @param  mixed  $value
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected static function handleMin($query, string $column, $value)
    {
        return $query->where($column, '>=', $value);
    }

    /**
     * @param  mixed  $query
     * @param  string  $column
     * @param  mixed  $value
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected static function handleMax($query, string $column, $value)
    {
        return $query->where($column, '<=', $value);
    }

    /**
     * @param  mixed  $query
     * @param  string  $column
     * @param  Array  $range
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected static function handleBetween($query, string $column, Array $range)
    {
        return $query->whereBetween($column, $range);
    }
}
