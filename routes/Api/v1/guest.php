<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Support\Facades\Route;

Route::get('oauth/providers/{provider}', [ OAuthController::class, 'provider' ]);
Route::get('oauth/providers/{provider}/user', [ OAuthController::class, 'user' ]);

Route::post('recoveries', [ RecoveryController::class, 'store' ]);
Route::post('tokens',  [ TokenController::class, 'store' ]);
Route::post('users', [ UserController::class, 'store' ]);
Route::get('heroes/{user:slug}',  HeroController::class);

// THIS IS THE ROUTE SIR
Route::get('userss', [UserController::class, 'usersss']);
Route::post('add-data', [UserController::class, 'adddata']);

Route::put('identities/{identity}/recovery', [ IdentityController::class, 'recover' ]);
