<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\Address\{ IndexAddress, ShowAddress, StoreAddress, UpdateAddress, DestroyAddress };
use App\Models\Address;
use App\Traits\Controllers\Api\v1\HasControllerHelpers;

class AddressController extends Controller
{
    use HasControllerHelpers;

    /**
     * Display a listing of the addresses.
     *
     * @param IndexAddress $request
     *
     * @return Response
     */
    public function index(IndexAddress $request)
    {
        $fields = $request->validated();
        $addresses = Address::select();

        return $this->filtered($addresses, $fields);
    }

    /**
     * Display the specified address.
     *
     * @param Address $address
     * @param ShowAddress $request
     *
     * @return Response
     */
    public function show(Address $address, ShowAddress $request)
    {
        return $address;
    }

    /**
     * Store a newly created address in storage.
     *
     * @param StoreAddress $request
     *
     * @return Response
     */
    public function store(StoreAddress $request)
    {
        $fields = $request->validated();

        return Address::create($fields);
    }

    /**
     * Update the specified address in storage.
     *
     * @param Address $address
     * @param UpdateAddress $request
     *
     * @return Response
     */
    public function update(Address $address, UpdateAddress $request)
    {
        $fields = $request->validated();

        $address->fill($fields);
        $address->save();

        return $address;
    }

    /**
     * Remove the specified address from storage.
     *
     * @param Address $address
     * @param DestroyAddress $request
     *
     * @return Response
     */
    public function destroy(Address $address, DestroyAddress $request)
    {
        $address->delete();
        return response()->json(null, 204);
    }
}
