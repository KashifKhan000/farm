<?php

namespace App\Policies\Api\v1;

use App\Models\{ CylinderAssetLog, User };

use Illuminate\Auth\Access\HandlesAuthorization;

class CylinderAssetLogPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any cylinder_asset_logs.
     *
     * @param  \App\Models\User  $user
     * 
     * @return mixed
     */
    public function index(User $user)
    {
        return $user->hasAbility('index', CylinderAssetLog::class);
    }

    /**
     * Determine whether the user can view the cylinder_asset_log.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CylinderAssetLog  $cylinder_asset_log
     * 
     * @return mixed
     */
    public function show(User $user, CylinderAssetLog $cylinder_asset_log)
    {
        return $user->hasAbility('show', CylinderAssetLog::class);
    }

    /**
     * Determine whether the user can create cylinder_asset_logs.
     *
     * @param  \App\Models\User  $user
     * 
     * @return mixed
     */
    public function store(User $user)
    {
        return $user->hasAbility('store', CylinderAssetLog::class);
    }

    /**
     * Determine whether the user can update the cylinder_asset_log.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CylinderAssetLog  $cylinder_asset_log
     * 
     * @return mixed
     */
    public function update(User $user, CylinderAssetLog $cylinder_asset_log)
    {
        return $user->hasAbility('update', CylinderAssetLog::class);
    }

    /**
     * Determine whether the user can delete the cylinder_asset_log.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CylinderAssetLog  $cylinder_asset_log
     * 
     * @return mixed
     */
    public function destroy(User $user, CylinderAssetLog $cylinder_asset_log)
    {
        return $user->hasAbility('destroy', CylinderAssetLog::class);
    }
}
