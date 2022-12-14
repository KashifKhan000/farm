<?php

namespace App\Http\Controllers\Api\v1;

use App\Guards\Api\v1\ApiGuard;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\Identity\{ ChangeIdentityPassword, IndexIdentity, ShowIdentity, StoreIdentity, UpdateIdentity, VerifyIdentity, RecoverIdentity, DestroyIdentity };
use App\Http\Resources\Api\v1\TokenResource;
use App\Models\Identity;
use App\Traits\Controllers\Api\v1\HasControllerHelpers;

class IdentityController extends Controller
{
    use HasControllerHelpers;

    /**
     * Display a listing of the identity.
     *
     * @param  IndexIdentity  $request
     *
     * @return Response
     */
    public function index(IndexIdentity $request)
    {
        $fields = $request->validated();
        $identities = Identity::select();

        return $this->filtered($identities, $fields);
    }

    /**
     * Display the specified identity.
     *
     * @param  Identity  $identity
     * @param  ShowIdentity  $request
     *
     * @return Response
     */
    public function show(Identity $identity, ShowIdentity $request)
    {
        return $identity;
    }

    /**
     * Store a newly created identity in storage.
     *
     * @param  StoreIdentity  $request
     *
     * @return Response
     */
    public function store(StoreIdentity $request)
    {
        $fields = array_merge($request->validated(), [
            'user_id' => request('user_id') ?? auth()->id(),
        ]);

        return Identity::create($fields);
    }

    /**
     * Update the specified identity in storage.
     *
     * @param  Identity  $identity
     * @param  UpdateIdentity  $request
     *
     * @return Response
     */
    public function update(Identity $identity, UpdateIdentity $request)
    {
        $fields = $request->validated();

        $identity->fill($fields);
        $identity->save();

        return $identity->only(array_keys($fields));
    }

    /**
     * Verify the specified identity.
     *
     * @param  Identity  $identity
     * @param  UpdateIdentity  $request
     *
     * @return Response
     */
    public function verify(Identity $identity, VerifyIdentity $request)
    {
        $identity->attemptVerify($request->validated());
        return response()->json(null, 204);
    }

    /**
     * Attempt to recover the specified identity.
     *
     * @param  Identity  $identity
     * @param  RecoverIdentity  $request
     *
     * @return Response
     */
    public function recover(Identity $identity, RecoverIdentity $request)
    {
        $fields = $request->validated();
        $user = $identity->attemptRecover($fields);
        $pat = $user->createToken(config('croft.token.name'));
        $token = new TokenResource($pat);

        return compact('token', 'user');
    }

    /**
     * Attempt to change the password for the specified identity.
     *
     * @param  Identity  $identity
     * @param  RecoverIdentity  $request
     *
     * @return Response
     */
    public function changePassword(Identity $identity, ChangeIdentityPassword $request)
    {
        $fields = $request->validated();
        $user = $identity->attemptChangePassword($fields);
        $pat = $user->createToken(config('croft.token.name'));
        $token = new TokenResource($pat);

        return compact('token', 'user');
    }

    /**
     * Remove the specified identity from storage.
     *
     * @param  Identity  $identity
     * @param  DestroyIdentity  $request
     *
     * @return Response
     */
    public function destroy(Identity $identity, DestroyIdentity $request)
    {
        $identity->delete();
        return response()->json(null, 204);
    }
}
