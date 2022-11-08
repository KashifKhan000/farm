<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
use App\Traits\Controllers\Api\v1\HasControllerHelpers;


class HeroController extends Controller
{
    use HasControllerHelpers;

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(User $user, Request $request)
    {
        if ($user->is_profile_public) {
            return $this->loaded($user, 'user', 'show');
        } else return response()->json([
            'message' => trans('auth.hero-profile-forbidden')
        ], 403);
    }
}
