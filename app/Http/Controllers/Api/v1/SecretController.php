<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\Secret\{ IndexSecret, ShowSecret, StoreSecret, UpdateSecret, DestroySecret };
use App\Models\Secret;
use App\Traits\Controllers\Api\v1\HasControllerHelpers;

use Illuminate\Support\Facades\Hash;

class SecretController extends Controller
{
    use HasControllerHelpers;

    /**
     * Display a listing of the secret.
     *
     * @param  \App\Http\Requests\Api\v1\Secret\IndexSecret  $request
     * @param  \App\Models\User  $user
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IndexSecret $request)
    {
        $fields = $request->validated();
        $secrets = Secret::select();

        return $this->filtered($secrets, $fields);
    }

    /**
     * Display the specified secret.
     *
     * @param  \App\Models\Secret  $secret
     * @param  \App\Http\Requests\Api\v1\Secret\ShowSecret  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Secret $secret, ShowSecret $request)
    {
        return $secret;
    }

    /**
     * Store a newly created secret in storage.
     *
     * @param  \App\Http\Requests\Api\v1\Secret\StoreSecret  $request
     * @param  \App\Models\User  $user
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSecret $request)
    {
        $fields = array_merge($request->validated(), [
            'user_id' => request('user_id') ?? auth()->id()
        ]);

        return Secret::create($fields);
    }

    /**
     * Update the authenticated user's secret in storage.
     *
     * @param  \App\Http\Requests\Api\v1\Secret\UpdateSecret  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSecret $request)
    {
        $fields = $request->validated();
        $secret = auth()->user()->secrets->where('type', 'password')->first();

        $secret->value = Hash::make($fields['password']);
        $secret->save();

        return response()->json(null, 204);
    }

    /**
     * Remove the specified secret from storage.
     *
     * @param  \App\Models\Secret  $secret
     * @param  \App\Http\Requests\Api\v1\Secret\DestroySecret  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Secret $secret, DestroySecret $request)
    {
        $secret->delete();
        return response()->json(null, 204);
    }
}
