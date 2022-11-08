<?php

namespace App\Policies\Api\v1;

use App\Models\{ EquipmentAsset, User };

use Illuminate\Auth\Access\HandlesAuthorization;

class EquipmentAssetPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any equipment_assets.
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
     * Determine whether the user can view the equipment_asset.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\EquipmentAsset  $equipment_asset
     *
     * @return mixed
     */
    public function show(User $user, EquipmentAsset $equipment_asset)
    {
        return true;
    }

    /**
     * Determine whether the user can create equipment_assets.
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
     * Determine whether the user can update the equipment_asset.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\EquipmentAsset  $equipment_asset
     *
     * @return mixed
     */
    public function update(User $user, EquipmentAsset $equipment_asset)
    {
        return true;
    }

    /**
     * Determine whether the user can delete the equipment_asset.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\EquipmentAsset  $equipment_asset
     *
     * @return mixed
     */
    public function destroy(User $user, EquipmentAsset $equipment_asset)
    {
        return $user->hasAbility('destroy', EquipmentAsset::class);
    }
}
