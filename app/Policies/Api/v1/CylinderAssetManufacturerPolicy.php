<?php

namespace App\Policies\Api\v1;

use App\Models\{ CylinderAssetManufacturer, User };

use Illuminate\Auth\Access\HandlesAuthorization;

class CylinderAssetManufacturerPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any cylinder_asset_manufacturers.
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
     * Determine whether the user can view the cylinder_asset_manufacturer.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CylinderAssetManufacturer  $cylinder_asset_manufacturer
     *
     * @return mixed
     */
    public function show(User $user, CylinderAssetManufacturer $cylinder_asset_manufacturer)
    {
        return true;
    }

    /**
     * Determine whether the user can create cylinder_asset_manufacturers.
     *
     * @param  \App\Models\User  $user
     *
     * @return mixed
     */
    public function store(User $user)
    {
        return $user->hasAbility('store', CylinderAssetManufacturer::class);
    }

    /**
     * Determine whether the user can update the cylinder_asset_manufacturer.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CylinderAssetManufacturer  $cylinder_asset_manufacturer
     *
     * @return mixed
     */
    public function update(User $user, CylinderAssetManufacturer $cylinder_asset_manufacturer)
    {
        return $user->hasAbility('update', CylinderAssetManufacturer::class);
    }

    /**
     * Determine whether the user can delete the cylinder_asset_manufacturer.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CylinderAssetManufacturer  $cylinder_asset_manufacturer
     *
     * @return mixed
     */
    public function destroy(User $user, CylinderAssetManufacturer $cylinder_asset_manufacturer)
    {
        return $user->hasAbility('destroy', CylinderAssetManufacturer::class);
    }
}
