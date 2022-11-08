<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\Gas\{ IndexGas, ShowGas, StoreGas, UpdateGas, DestroyGas };
use App\Models\Gas;
use App\Traits\Controllers\Api\v1\HasControllerHelpers;

class GasController extends Controller
{
    use HasControllerHelpers;

    /**
     * Display a listing of the gases.
     *
     * @param  \App\Http\Requests\Api\v1\Gas\IndexGas  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IndexGas $request)
    {
        $fields = $request->validated();
        $gases = Gas::select();

        return $this->filtered($gases, $fields);
    }

    /**
     * Display the specified gas.
     *
     * @param  \App\Models\Gas  $gas
     * @param  \App\Http\Requests\Api\v1\Gas\ShowGas  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Gas $gas, ShowGas $request)
    {
        return $gas;
    }

    /**
     * Store a newly created gas in storage.
     *
     * @param  \App\Http\Requests\Api\v1\Gas\StoreGas  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGas $request)
    {
        $fields = $request->validated();

        return Gas::create($fields)->fresh();
    }

    /**
     * Update the specified gas in storage.
     *
     * @param  \App\Models\Gas  $gas
     * @param  \App\Http\Requests\Api\v1\Gas\UpdateGas  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Gas $gas, UpdateGas $request)
    {
        $fields = $request->validated();

        $gas->fill($fields);
        $gas->save();

        return $gas;
    }

    /**
     * Remove the specified gas from storage.
     *
     * @param  \App\Models\Gas  $gas
     * @param  \App\Http\Requests\Api\v1\Gas\DestroyGas  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gas $gas, DestroyGas $request)
    {
        $gas->delete();
        return response()->json(null, 204);
    }
}
