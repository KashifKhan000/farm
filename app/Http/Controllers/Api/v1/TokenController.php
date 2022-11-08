<?php

namespace App\Http\Controllers\Api\v1;

use App\Guards\Api\v1\ApiGuard;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\Token\{ IndexToken, ShowToken, StoreToken, UpdateToken, RefreshToken, DestroyToken };
use App\Http\Resources\Api\v1\TokenResource;
use App\Models\PersonalAccessToken;
use App\Events\Api\v1\Token\TokenCreated;
use App\Traits\Controllers\Api\v1\HasControllerHelpers;

class TokenController extends Controller
{
    use HasControllerHelpers;

    /**
     * Display a listing of the token.
     *
     * @param IndexToken $request
     *
     * @return Response
     */
    public function index(IndexToken $request)
    {
        $fields = $request->validated();
        $tokens = PersonalAccessToken::select();

        return $this->filtered($tokens, $fields);
    }

    /**
     * Display the specified token.
     *
     * @param PersonalAccessToken $token
     * @param ShowToken $request
     *
     * @return Response
     */
    public function show(PersonalAccessToken $token, ShowToken $request)
    {
        return $token;
    }

    /**
     * Store a newly created token in storage.
     *
     * @param StoreToken $request
     *
     * @return Response
     */
    public function store(StoreToken $request)
    {
        $fields = $request->validated();
        $user = ApiGuard::getInstance()->attempt($fields);
        $pat = $user->createToken(config('croft.token.name'));
        $token = new TokenResource($pat);
        $identity = $user->identities()
                         ->whereValue($fields['identity']['value'])
                         ->first();

        TokenCreated::dispatch($pat);

        $user->load('address', 'company');

        return response()->json(compact('token', 'identity', 'user'), 201);
    }

    /**
     * Update the specified token in storage.
     *
     * @param PersonalAccessToken $token
     * @param UpdateToken $request
     *
     * @return Response
     */
    public function update(PersonalAccessToken $token, UpdateToken $request)
    {
        $fields = $request->validated();

        $token->fill($fields);
        $token->save();

        return $token->only(array_keys($fields));
    }

    /**
     * Update the specified token in storage.
     *
     * @param PersonalAccessToken $token
     * @param RefreshToken $request
     *
     * @return Response
     */
    public function refresh(PersonalAccessToken $token, RefreshToken $request)
    {
        $user = ApiGuard::getInstance()->user();
        $threshold = now()->addMinutes(config('croft.token.refresh_threshold'));

        if ($token->created_at->lte($threshold)) {
            $token = $user->createToken(config('croft.token.name'));
            TokenCreated::dispatch($token);
        }

        $user->load('address', 'company');

        $token = new TokenResource($token);

        return response()->json(compact('token', 'user'), 200);
    }

    /**
     * Remove the specified token from storage.
     *
     * @param PersonalAccessToken $token
     * @param DestroyToken $request
     *
     * @return Response
     */
    public function destroy(PersonalAccessToken $token, DestroyToken $request)
    {
        $token->delete();
        return response()->json(null, 204);
    }
}
