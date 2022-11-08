<?php

namespace App\Policies\Api\v1;

use App\Models\{ Gas, User };

use Illuminate\Auth\Access\HandlesAuthorization;

class GasPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any gases.
     *
     * @param  \App\Models\User  $user
     * 
     * @return mixed
     */
    public function index(User $user)
    {
        return $user->hasAbility('index', Gas::class);
    }

    /**
     * Determine whether the user can view the gas.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Gas  $gas
     * 
     * @return mixed
     */
    public function show(User $user, Gas $gas)
    {
        return $user->hasAbility('show', Gas::class);
    }

    /**
     * Determine whether the user can create gases.
     *
     * @param  \App\Models\User  $user
     * 
     * @return mixed
     */
    public function store(User $user)
    {
        return $user->hasAbility('store', Gas::class);
    }

    /**
     * Determine whether the user can update the gas.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Gas  $gas
     * 
     * @return mixed
     */
    public function update(User $user, Gas $gas)
    {
        return $user->hasAbility('update', Gas::class);
    }

    /**
     * Determine whether the user can delete the gas.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Gas  $gas
     * 
     * @return mixed
     */
    public function destroy(User $user, Gas $gas)
    {
        return $user->hasAbility('destroy', Gas::class);
    }
}
