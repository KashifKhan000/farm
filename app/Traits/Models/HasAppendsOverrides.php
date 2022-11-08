<?php

namespace App\Traits\Models;

trait HasAppendsOverrides
{
    public static $withoutAppends = false;
    public static $appendsOverride;

    public function scopeWithoutAppends($query)
    {
        self::$withoutAppends = true;

        return $query;
    }

    public function scopeAppendsOverride($query, $appends)
    {
        self::$appendsOverride = $appends;

        return $query;
    }

    protected function getArrayableAppends()
    {
        if (self::$withoutAppends) {
            return [];
        } else if ( is_array(self::$appendsOverride) ){
            return self::$appendsOverride;
        }

        return parent::getArrayableAppends();
    }
}
