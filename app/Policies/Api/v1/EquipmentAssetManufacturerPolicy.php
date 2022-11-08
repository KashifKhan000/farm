<?php

namespace App\Policies\Api\v1;

use App\Models\{ EquipmentAssetManufacturer, User };

use Illuminate\Auth\Access\HandlesAuthorization;

class EquipmentAssetManufacturerPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any equipment_asset_manufacturers.
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
     * Determine whether the user can view the equipment_asset_manufacturer.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\EquipmentAssetManufacturer  $equipment_asset_manufacturer
     *
     * @return mixed
     */
    public function show(User $user, EquipmentAssetManufacturer $equipment_asset_manufacturer)
    {
        return true;
    }

    /**
     * Determine whether the user can create equipment_asset_manufacturers.
     *
     * @param  \App\Models\User  $user
     *
     * @return mixed
     */
    public function store(User $user)
    {
        return $user->hasAbility('store', EquipmentAssetManufacturer::class);
    }

    /**
     * Determine whether the user can update the equipment_asset_manufacturer.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\EquipmentAssetManufacturer  $equipment_asset_manufacturer
     *
     * @return mixed
     */
    public function update(User $user, EquipmentAssetManufacturer $equipment_asset_manufacturer)
    {
        return $user->hasAbility('update', EquipmentAssetManufacturer::class);
    }

    /**
     * Determine whether the user can delete the equipment_asset_manufacturer.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\EquipmentAssetManufacturer  $equipment_asset_manufacturer
     *
     * @return mixed
     */
    public function destroy(User $user, EquipmentAssetManufacturer $equipment_asset_manufacturer)
    {
        return $user->hasAbility('destroy', EquipmentAssetManufacturer::class);
    }
}
