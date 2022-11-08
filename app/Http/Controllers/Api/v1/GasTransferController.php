<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\GasTransfer\{ IndexGasTransfer, ShowGasTransfer, StoreGasTransfer, DestroyGasTransfer };
use App\Models\{GasTransfer, GasMovement};
use App\Traits\Controllers\Api\v1\HasControllerHelpers;
use Illuminate\Support\Str;

class GasTransferController extends Controller
{
    use HasControllerHelpers;

    /**
     * Display a listing of the gas_transfers.
     *
     * @param  \App\Http\Requests\Api\v1\GasTransfer\IndexGasTransfer  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IndexGasTransfer $request)
    {
        $fields = $request->validated();
        $gas_transfers = GasTransfer::select();

        return $this->filtered($gas_transfers, $fields);
    }

    /**
     * Display the specified gas_transfer.
     *
     * @param  \App\Models\GasTransfer  $gas_transfer
     * @param  \App\Http\Requests\Api\v1\GasTransfer\ShowGasTransfer  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function show(GasTransfer $gas_transfer, ShowGasTransfer $request)
    {
        return $gas_transfer;
    }

    /**
     * Store a newly created gas_movement in storage.
     *
     * @param  \App\Http\Requests\Api\v1\GasMovement\StoreGasTransfer  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGasTransfer $request)
    {
        $fields = $request->validated();

        $gas_transfer = GasTransfer::firstNew([
            'owner_id' => $fields['owner_id'],
            'owner_type' => Str::start($fields['owner_type'], config('croft.models.namespace')),
        ]);

        $gas_transfer->recovery_equipment_id = $fields['recovery_equipment_id'] ?? null;

        $gas_transfer->save();


        $gas_movement = $gas_transfer->movements()->create($fields);





        // return $gas_movement;
    }

    /**
     * Remove the specified gas_transfer from storage.
     *
     * @param  \App\Models\GasTransfer  $gas_transfer
     * @param  \App\Http\Requests\Api\v1\GasTransfer\DestroyGasTransfer  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(GasTransfer $gas_transfer, DestroyGasTransfer $request)
    {
        $gas_transfer->delete();
        return response()->json(null, 204);
    }
}
