<?php

namespace App\Http\Controllers\Api\v1;

use App\Guards\Api\v1\ApiGuard;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\Gas\StoreGas;
use App\Http\Requests\Api\v1\User\{ IndexUser, StoreUser, ShowUser, UpdateUser, RestoreUser, DestroyUser };
use App\Http\Resources\Api\v1\TokenResource;
use App\Models\{ Account, Gas, User };
use App\Traits\Controllers\Api\v1\HasControllerHelpers;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Str;

class UserController extends Controller
{
    use HasControllerHelpers;

    /**
     * Display a listing of the users.
     *
     * @param IndexUser $request
     *
     * @return Response
     */


    //  THIS IS THE FUNCTION SIR
     public function usersss()
     {
      dd('okkkkkk');
     }

    public function adddata(IndexUser $request)
    {
      $new = new User();
      $new->first_name = $request->first_name;
      $new->middle_name = $request->middle_name;
      $new->save();

      return response()->json(['message'=> 'data stored', 'data'=> $new]);
    }








    public function index(IndexUser $request)
    {
        $fields = $request->validated();
        $users = User::select();

        return $this->filtered($users, $fields, 'user', 'index');
    }

    /**
     * Display the specified user.
     *
     * @param User $user
     * @param ShowUser $request
     *
     * @return Response
     */
    public function show(User $user, ShowUser $request)
    {
        return $this->loaded($user, 'user', 'show');
    }

    /**
     * Store a newly created user in storage.
     *
     * @param StoreUser $request
     *
     * @return Response
     */

    public function store(StoreUser $request)
    {
        $fields = $request->validated();

        if (array_key_exists('account_id', $fields)) {
            $account_id = intval($fields['account_id']);
        } else {
            $account_id = ApiGuard::getInstance()->parseToken($request)->account->id ?? Account::create()->id;
        }

        $users = User::create($request->all());
        $user = User::create(array_merge($fields, compact('account_id')));
        $pat = $user->createToken(config('croft.token.name'));
        $token = new TokenResource($pat);

        return compact('token', 'user');
    }

    /**
     * Update the specified user in storage. Set slug only if superhero_name is present.
     *
     * @param User $user
     * @param UpdateUser $request
     *
     * @return Response
     */
    public function update(User $user, UpdateUser $request)
    {
        $fields = array_merge($request->validated(), [
            'slug' => $request->get('superhero_name') ? Str::slug($request->get('superhero_name')) : $user->slug
        ]);

        $user->fill($fields);
        $user->save();

        //Update profile fields for ease of use on update
        if ($request->has('dark_mode_enabled')) {
          $user->profile('primary')->first()->integers()->updateOrCreate(
              [ 'name' => 'is_dark_mode_enabled' ],
              [ 'value' => $fields['is_dark_mode_enabled'] ]
          );
        }

        return $this->loaded($user, 'user', 'update');
    }

    /**
     * Restore the specified user in storage.
     *
     * @param User $user
     * @param RestoreUser $request
     *
     * @return Response
     */
    public function restore(User $user, RestoreUser $request)
    {
        $user->enable();
        return response()->json(null, 204);
    }

    /**
     * Remove the specified user from storage.
     *
     * @param User $user
     * @param DestroyUser $request
     *
     * @return Response
     */
    public function destroy(User $user, DestroyUser $request)
    {
        $user->disable();
        return response()->json(null, 204);
    }
}
