<?php

namespace App\Policies\Api\v1;

use App\Models\{ GasMovement, User };

use Illuminate\Auth\Access\HandlesAuthorization;

class GasMovementPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any gas_movements.
     *
     * @param  \App\Models\User  $user
     * 
     * @return mixed
     */
    public function index(User $user)
    {
        return $user->hasAbility('index', GasMovement::class);
    }

    /**
     * Determine whether the user can view the gas_movement.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\GasMovement  $gas_movement
     * 
     * @return mixed
     */
    public function show(User $user, GasMovement $gas_movement)
    {
        if ($gas_movement->owner) {
            if ($user->id === $gas_movement->owner->id) {
                return true;
            } else if ($user->can('show', $gas_movement->owner)) {
                return true;
            }
        }
        
        return $user->hasAbility('show', GasMovement::class);
    }

    /**
     * Determine whether the user can create gas_movements.
     *
     * @param  \App\Models\User  $user
     * 
     * @return mixed
     */
    public function store(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the gas_movement.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\GasMovement  $gas_movement
     * 
     * @return mixed
     */
    public function update(User $user, GasMovement $gas_movement)
    {
        if ($gas_movement->owner) {
            if ($user->id === $gas_movement->owner->id) {
                return true;
            } else if ($user->can('update', $gas_movement->owner)) {
                return true;
            }
        }
        
        return $user->hasAbility('update', GasMovement::class);
    }

    /**
     * Determine whether the user can delete the gas_movement.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\GasMovement  $gas_movement
     * 
     * @return mixed
     */
    public function destroy(User $user, GasMovement $gas_movement)
    {
        if ($gas_movement->owner) {
            if ($user->id === $gas_movement->owner->id) {
                return true;
            } else if ($user->can('destroy', $gas_movement->owner)) {
                return true;
            }
        }
        
        return $user->hasAbility('destroy', GasMovement::class);
    }
}
