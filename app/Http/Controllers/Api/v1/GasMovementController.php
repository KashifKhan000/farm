<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\GasMovement\{ IndexGasMovement, ShowGasMovement, StoreGasMovement, UpdateGasMovement, DestroyGasMovement };
use App\Models\{GasMovement, GasTransfer, EquipmentAssetCircuit, CylinderAsset};
use App\Traits\Controllers\Api\v1\{HasControllerHelpers, HasAssetFields};
use Illuminate\Support\Str;

class GasMovementController extends Controller
{
    use HasControllerHelpers, HasAssetFields;

    /**
     * Display a listing of the gas_movements.
     *
     * @param  \App\Http\Requests\Api\v1\GasMovement\IndexGasMovement  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IndexGasMovement $request)
    {
        $fields = $request->validated();
        $gas_movements = GasMovement::select();

        return $this->filtered($gas_movements, $fields);
    }

    /**
     * Display the specified gas_movement.
     *
     * @param  \App\Models\GasMovement  $gas_movement
     * @param  \App\Http\Requests\Api\v1\GasMovement\ShowGasMovement  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function show(GasMovement $gas_movement, ShowGasMovement $request)
    {
        return $gas_movement;
    }

    /**
     * Store a newly created gas_movement in storage.
     *
     * @param  \App\Http\Requests\Api\v1\GasMovement\StoreGasMovement  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGasMovement $request)
    {
        $fields = $request->validated();

        //Charge equipment asset with cylinder asset
        if (!empty($fields['from_cylinder_asset_id']) && !empty($fields['to_equipment_asset_circuit_id'])) {
            $from_cylinder_asset = CylinderAsset::find($fields['from_cylinder_asset_id'])->gases()->where('gas_id', $fields['gas_id'])->first();


            $to_equipment_asset_circuit = EquipmentAssetCircuit::find($fields['to_equipment_asset_circuit_id'])->gases()->firstOrNew([
                'owner_type' => 'EquipmentAssetCircuit',
                'owner_id' => $fields['to_equipment_asset_circuit_id'],
                'gas_id' => $fields['gas_id']
            ]);

            return $to_equipment_asset_circuit;
        }

        // $gas_transfer = GasTransfer::firstOrCreate([
        //     'owner_id' => $fields['owner_id'],
        //     'owner_type' => Str::start($fields['owner_type'], config('croft.models.namespace')),
        //     'recovery_equipment_id' => $fields['recovery_equipment_id'] ?? null,
        // ]);

        // $gas_movement = $gas_transfer->movements()->create($fields);





        // return $gas_movement;
    }

    /**
     * Update the specified gas_movement in storage.
     *
     * @param  \App\Models\GasMovement  $gas_movement
     * @param  \App\Http\Requests\Api\v1\GasMovement\UpdateGasMovement  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function update(GasMovement $gas_movement, UpdateGasMovement $request)
    {
        $fields = $request->validated();

        $gas_movement->fill($fields);
        $gas_movement->save();

        return $gas_movement;
    }

    /**
     * Remove the specified gas_movement from storage.
     *
     * @param  \App\Models\GasMovement  $gas_movement
     * @param  \App\Http\Requests\Api\v1\GasMovement\DestroyGasMovement  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(GasMovement $gas_movement, DestroyGasMovement $request)
    {
        $gas_movement->delete();
        return response()->json(null, 204);
    }
}
