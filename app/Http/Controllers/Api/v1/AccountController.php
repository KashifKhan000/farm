<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\Account\{ IndexAccount, ShowAccount, StoreAccount, UpdateAccount, DestroyAccount };
use App\Models\Account;
use App\Traits\Controllers\Api\v1\HasControllerHelpers;

class AccountController extends Controller
{
    use HasControllerHelpers;

    /**
     * Display a listing of the account.
     *
     * @param IndexAccount $request
     *
     * @return Response
     */

    public function usersss()
    {
      dd('OKKK');
    }

    public function index(IndexAccount $request)
    {
        $fields = $request->validated();
        $accounts = Account::select();

        return $this->filtered($accounts, $fields);
    }

    /**
     * Display the specified account.
     *
     * @param Account $account
     * @param ShowAccount $request
     *
     * @return Response
     */
    public function show(Account $account, ShowAccount $request)
    {
        return $account;
    }

    /**
     * Store a newly created account in storage.
     *
     * @param StoreAccount $request
     *
     * @return Response
     */
    public function store(StoreAccount $request)
    {
        $fields = $request->validated();

        return Account::create($fields);
    }

    /**
     * Update the specified account in storage.
     *
     * @param Account $account
     * @param UpdateAccount $request
     *
     * @return Response
     */
    public function update(Account $account, UpdateAccount $request)
    {
        $fields = $request->validated();

        $account->fill($fields);
        $account->save();

        return $account->only(array_keys($fields));
    }

    /**
     * Remove the specified account from storage.
     *
     * @param Account $account
     * @param DestroyAccount $request
     *
     * @return Response
     */
    public function destroy(Account $account, DestroyAccount $request)
    {
        $account->delete();
        return response()->json(null, 204);
    }
}
