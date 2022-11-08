<?php

namespace App\Traits\Models;

use App\Models\Image;

trait HasImages
{
    /**
     * @return MorphOne
     */
    public function image(string $name = 'primary')
    {
        return $this->morphOne(Image::class, 'owner')->whereName($name);
    }

    /**
     * @return MorphMany
     */
    public function images()
    {
        return $this->morphMany(Image::class, 'owner');
    }
}
