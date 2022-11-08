<?php

namespace App\Traits\Models;

use App\Models\User;

trait HasUser
{
    /**
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo;
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function matchesUser(User $user)
    {
        return $user->getKey() == $this->user()->where('id', $user->getKey())->exists();
    }
}
