<?php

namespace App\Policies\Api\v1;

use App\Models\{ RecoveryEquipment, User };

use Illuminate\Auth\Access\HandlesAuthorization;

class RecoveryEquipmentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any recovery_equipments.
     *
     * @param  \App\Models\User  $user
     *
     * @return mixed
     */
    public function index(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the recovery_equipment.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\RecoveryEquipment  $recovery_equipment
     *
     * @return mixed
     */
    public function show(User $user, RecoveryEquipment $recovery_equipment)
    {
        return true;
    }

    /**
     * Determine whether the user can create recovery_equipments.
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
     * Determine whether the user can update the recovery_equipment.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\RecoveryEquipment  $recovery_equipment
     *
     * @return mixed
     */
    public function update(User $user, RecoveryEquipment $recovery_equipment)
    {
        if ($user->id === $recovery_equipment->user_id) {
            return true;
        }
        return $user->hasAbility('update', RecoveryEquipment::class);
    }

    /**
     * Determine whether the user can delete the recovery_equipment.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\RecoveryEquipment  $recovery_equipment
     *
     * @return mixed
     */
    public function destroy(User $user, RecoveryEquipment $recovery_equipment)
    {
        return $user->hasAbility('destroy', RecoveryEquipment::class);
    }

    /**
     * Determine whether the user can own the recovery_equipment
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ServiceEvent  $service_event
     *
     * @return mixed
     */
    public function own(User $user, RecoveryEquipment $recovery_equipment)
    {
        return $user->hasAbility('own', RecoveryEquipment::class);
    }
}
