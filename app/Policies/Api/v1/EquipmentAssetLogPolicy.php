<?php

namespace App\Policies\Api\v1;

use App\Models\{ EquipmentAssetLog, User };

use Illuminate\Auth\Access\HandlesAuthorization;

class EquipmentAssetLogPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any equipment_asset_logs.
     *
     * @param  \App\Models\User  $user
     * 
     * @return mixed
     */
    public function index(User $user)
    {
        return $user->hasAbility('index', EquipmentAssetLog::class);
    }

    /**
     * Determine whether the user can view the equipment_asset_log.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\EquipmentAssetLog  $equipment_asset_log
     * 
     * @return mixed
     */
    public function show(User $user, EquipmentAssetLog $equipment_asset_log)
    {
        return $user->hasAbility('show', EquipmentAssetLog::class);
    }

    /**
     * Determine whether the user can create equipment_asset_logs.
     *
     * @param  \App\Models\User  $user
     * 
     * @return mixed
     */
    public function store(User $user)
    {
        return $user->hasAbility('store', EquipmentAssetLog::class);
    }

    /**
     * Determine whether the user can update the equipment_asset_log.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\EquipmentAssetLog  $equipment_asset_log
     * 
     * @return mixed
     */
    public function update(User $user, EquipmentAssetLog $equipment_asset_log)
    {
        return $user->hasAbility('update', EquipmentAssetLog::class);
    }

    /**
     * Determine whether the user can delete the equipment_asset_log.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\EquipmentAssetLog  $equipment_asset_log
     * 
     * @return mixed
     */
    public function destroy(User $user, EquipmentAssetLog $equipment_asset_log)
    {
        return $user->hasAbility('destroy', EquipmentAssetLog::class);
    }
}
