<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\EquipmentAssetCircuit\{ IndexEquipmentAssetCircuit, ShowEquipmentAssetCircuit, StoreEquipmentAssetCircuit, UpdateEquipmentAssetCircuit, DestroyEquipmentAssetCircuit };
use App\Models\{EquipmentAsset, EquipmentAssetCircuit};
use App\Traits\Controllers\Api\v1\HasControllerHelpers;

class EquipmentAssetCircuitController extends Controller
{
    use HasControllerHelpers;

    /**
     * Display a listing of the equipment_asset_circuits.
     *
     * @param  \App\Http\Requests\Api\v1\EquipmentAssetCircuit\IndexEquipmentAssetCircuit  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(EquipmentAsset $equipment_asset, IndexEquipmentAssetCircuit $request)
    {
        $fields = $request->validated();
        $equipment_asset_circuits = EquipmentAssetCircuit::select();

        return $this->filtered($equipment_asset_circuits, $fields);
    }

    /**
     * Display the specified equipment_asset_circuit.
     *
     * @param  \App\Models\EquipmentAssetCircuit  $equipment_asset_circuit
     * @param  \App\Http\Requests\Api\v1\EquipmentAssetCircuit\ShowEquipmentAssetCircuit  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function show(EquipmentAsset $equipment_asset, EquipmentAssetCircuit $equipment_asset_circuit, ShowEquipmentAssetCircuit $request)
    {
        return $equipment_asset_circuit;
    }

    /**
     * Store a newly created equipment_asset_circuit in storage.
     *
     * @param  \App\Http\Requests\Api\v1\EquipmentAssetCircuit\StoreEquipmentAssetCircuit  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(EquipmentAsset $equipment_asset, StoreEquipmentAssetCircuit $request)
    {
        $fields = array_merge($request->validated(), [
            'type' => 'Secondary'
        ]);

        $equipment_asset_circuit = $equipment_asset->circuits()->create($fields);

        foreach ($fields['gases'] as $gas) {
            $asset_gas = $equipment_asset_circuit->gases()->firstOrNew(['gas_id' => $gas['gas_id']]);
            $asset_gas->purity = $gas['purity'];
            $asset_gas->save();
        }

        return $equipment_asset->fresh();
    }

    /**
     * Update the specified equipment_asset_circuit in storage.
     *
     * @param  \App\Models\EquipmentAssetCircuit  $equipment_asset_circuit
     * @param  \App\Http\Requests\Api\v1\EquipmentAssetCircuit\UpdateEquipmentAssetCircuit  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function update(EquipmentAsset $equipment_asset, EquipmentAssetCircuit $equipment_asset_circuit, UpdateEquipmentAssetCircuit $request)
    {
        $fields = $request->validated();

        $equipment_asset->circuits()->findOrFail($equipment_asset_circuit->id);
        $equipment_asset_circuit->save();

        foreach ($fields['gases'] as $gas) {
            $asset_gas = $equipment_asset_circuit->gases()->firstOrNew(['gas_id' => $gas['gas_id']]);
            $asset_gas->purity = $gas['purity'];
            $asset_gas->save();
        }

        return $equipment_asset->fresh();
    }

    /**
     * Remove the specified equipment_asset_circuit from storage.
     *
     * @param  \App\Models\EquipmentAssetCircuit  $equipment_asset_circuit
     * @param  \App\Http\Requests\Api\v1\EquipmentAssetCircuit\DestroyEquipmentAssetCircuit  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(EquipmentAsset $equipment_asset, EquipmentAssetCircuit $equipment_asset_circuit, DestroyEquipmentAssetCircuit $request)
    {
        $equipment_asset_circuit->delete();
        return response()->json(null, 204);
    }
}
