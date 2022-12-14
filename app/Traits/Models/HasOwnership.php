<?php

namespace App\Traits\Models;

use Illuminate\Support\Str;

trait HasOwnership
{
    /**
     * Retrieve the owner of this resource.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function owner()
    {
        return $this->morphTo();
    }

    /**
     * Ensure passed type has correct prefix and assign it.
     *
     * @return void
     */
    public function setOwnerTypeAttribute(string $owner_type)
    {
        $this->attributes['owner_type'] = Str::start($owner_type, config('croft.models.namespace'));
    }
}
