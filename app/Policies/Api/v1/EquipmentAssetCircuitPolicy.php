<?php

namespace App\Policies\Api\v1;

use App\Models\{ EquipmentAssetCircuit, EquipmentAsset, User };

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Log;

class EquipmentAssetCircuitPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any equipment_asset_circuits.
     *
     * @param  \App\Models\User  $user
     *
     * @return mixed
     */
    public function index(User $user)
    {
        return $user->hasAbility('index', EquipmentAssetCircuit::class);
    }

    /**
     * Determine whether the user can view the equipment_asset_circuit.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\EquipmentAssetCircuit  $equipment_asset_circuit
     *
     * @return mixed
     */
    public function show(User $user, EquipmentAssetCircuit $equipment_asset_circuit)
    {
        return $user->hasAbility('show', EquipmentAssetCircuit::class);
    }

    /**
     * Determine whether the user can create equipment_asset_circuits.
     *
     * @param  \App\Models\User  $user
     *
     * @return mixed
     */
    public function store(User $user)
    {
        return $user->hasAbility('store', EquipmentAssetCircuit::class);
    }

    /**
     * Determine whether the user can update the equipment_asset_circuit.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\EquipmentAssetCircuit  $equipment_asset_circuit
     *
     * @return mixed
     */
    public function update(User $user, EquipmentAssetCircuit $equipment_asset_circuit)
    {
        return $user->hasAbility('update', EquipmentAssetCircuit::class);
    }

    /**
     * Determine whether the user can delete the equipment_asset_circuit.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\EquipmentAssetCircuit  $equipment_asset_circuit
     *
     * @return mixed
     */
    public function destroy(User $user, EquipmentAssetCircuit $equipment_asset_circuit)
    {
        return $user->hasAbility('destroy', EquipmentAssetCircuit::class);
    }
}
