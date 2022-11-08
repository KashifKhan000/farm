<?php

namespace App\Policies\Api\v1;

use App\Models\{ EquipmentAssetClassification, User };

use Illuminate\Auth\Access\HandlesAuthorization;

class EquipmentAssetClassificationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any equipment_asset_classifications.
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
     * Determine whether the user can view the equipment_asset_classification.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\EquipmentAssetClassification  $equipment_asset_classification
     *
     * @return mixed
     */
    public function show(User $user, EquipmentAssetClassification $equipment_asset_classification)
    {
        return true;
    }

    /**
     * Determine whether the user can create equipment_asset_classifications.
     *
     * @param  \App\Models\User  $user
     *
     * @return mixed
     */
    public function store(User $user)
    {
        return $user->hasAbility('store', EquipmentAssetClassification::class);
    }

    /**
     * Determine whether the user can update the equipment_asset_classification.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\EquipmentAssetClassification  $equipment_asset_classification
     *
     * @return mixed
     */
    public function update(User $user, EquipmentAssetClassification $equipment_asset_classification)
    {
        return $user->hasAbility('update', EquipmentAssetClassification::class);
    }

    /**
     * Determine whether the user can delete the equipment_asset_classification.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\EquipmentAssetClassification  $equipment_asset_classification
     *
     * @return mixed
     */
    public function destroy(User $user, EquipmentAssetClassification $equipment_asset_classification)
    {
        return $user->hasAbility('destroy', EquipmentAssetClassification::class);
    }
}
