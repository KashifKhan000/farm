<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\UserServiceEvent\{ IndexUserServiceEvent, ShowUserServiceEvent, StoreUserServiceEvent, UpdateUserServiceEvent, DestroyUserServiceEvent };
use App\Models\{User, ServiceEvent, UserServiceEvent};
use App\Traits\Controllers\Api\v1\HasControllerHelpers;

class UserServiceEventController extends Controller
{
    use HasControllerHelpers;

    /**
     * Display a listing of the user_service_events.
     *
     * @param  \App\Http\Requests\Api\v1\UserServiceEvent\IndexUserServiceEvent  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user, IndexUserServiceEvent $request)
    {
        $this->authorize('index', [UserServiceEvent::class, $user->id]);
        $fields = $request->validated();
        $user_service_events = $user->service_events();

        return $this->filtered($user_service_events, $fields, 'user_service_event', 'index');
    }

    /**
     * Display the specified user_service_event.
     *
     * @param  \App\Models\UserServiceEvent  $user_service_event
     * @param  \App\Http\Requests\Api\v1\UserServiceEvent\ShowUserServiceEvent  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function show(User $user, ServiceEvent $service_event, ShowUserServiceEvent $request)
    {
        $this->authorize('show', [UserServiceEvent::class, $user->id]);
        return $this->loaded($service_event, 'user_service_event', 'show');
    }
}
