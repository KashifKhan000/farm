<?php

namespace App\Policies\Api\v1;

use App\Models\{ CylinderAsset, User };

use Illuminate\Auth\Access\HandlesAuthorization;

class CylinderAssetPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any cylinder_assets.
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
     * Determine whether the user can view the cylinder_asset.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CylinderAsset  $cylinder_asset
     *
     * @return mixed
     */
    public function show(User $user, CylinderAsset $cylinder_asset)
    {
        return true;
    }

    /**
     * Determine whether the user can create cylinder_assets.
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
     * Determine whether the user can update the cylinder_asset.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CylinderAsset  $cylinder_asset
     *
     * @return mixed
     */
    public function update(User $user, CylinderAsset $cylinder_asset)
    {
        if ($user->id === $cylinder_asset->user_id) {
            return true;
        } else if (!empty($cylinder_asset->site) && empty($cylinder_asset->user_id)){
            return true;
        }
        return $user->hasAbility('update', CylinderAsset::class);
    }

    /**
     * Determine whether the user can delete the cylinder_asset.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CylinderAsset  $cylinder_asset
     *
     * @return mixed
     */
    public function destroy(User $user, CylinderAsset $cylinder_asset)
    {
        if ($user->id === $cylinder_asset->user_id) {
            return true;
        } else if (!empty($cylinder_asset->site) && empty($cylinder_asset->user_id)) {
            return true;
        }
        return $user->hasAbility('destroy', CylinderAsset::class);
    }

    /**
     * Determine whether the user can delete the service_event.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CylinderAsset  $cylinder_asset
     *
     * @return mixed
     */
    public function own(User $user, CylinderAsset $cylinder_asset)
    {
        if ($user->id === $cylinder_asset->user_id) {
            return true;
        }
        return $user->hasAbility('own', CylinderAsset::class);
    }
}
