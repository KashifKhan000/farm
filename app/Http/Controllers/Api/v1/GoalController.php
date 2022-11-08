<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\Goal\{ IndexGoal, ShowGoal, StoreGoal, UpdateGoal, DestroyGoal };
use App\Models\Goal;
use App\Traits\Controllers\Api\v1\HasControllerHelpers;

class GoalController extends Controller
{
    use HasControllerHelpers;

    /**
     * Display a listing of the goals.
     *
     * @param  \App\Http\Requests\Api\v1\Goal\IndexGoal  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IndexGoal $request)
    {
        $fields = $request->validated();
        $goals = Goal::select()->where('user_id', auth()->id());

        return $this->filtered($goals, $fields, 'goal', 'index');
    }

    /**
     * Display the specified goal.
     *
     * @param  \App\Models\Goal  $goal
     * @param  \App\Http\Requests\Api\v1\Goal\ShowGoal  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Goal $goal, ShowGoal $request)
    {
        return $this->loaded($goal, 'goal', 'show');
    }

    /**
     * Store a newly created goal in storage.
     *
     * @param  \App\Http\Requests\Api\v1\Goal\StoreGoal  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGoal $request)
    {
        $fields = array_merge($request->validated(), [
            'user_id' => $request->get('user_id') ?? auth()->id(),
        ]);

        return $this->loaded(Goal::create($fields)->fresh(), 'goal', 'store');
    }

    /**
     * Update the specified goal in storage.
     *
     * @param  \App\Models\Goal  $goal
     * @param  \App\Http\Requests\Api\v1\Goal\UpdateGoal  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Goal $goal, UpdateGoal $request)
    {
        $fields = array_merge($request->validated(), [
            'user_id' => $request->input('user_id') ?? auth()->id(),
        ]);

        $goal->fill($fields);
        $goal->save();

        return $goal;
    }

    /**
     * Remove the specified goal from storage.
     *
     * @param  \App\Models\Goal  $goal
     * @param  \App\Http\Requests\Api\v1\Goal\DestroyGoal  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Goal $goal, DestroyGoal $request)
    {
        $goal->delete();
        return response()->json(null, 204);
    }
}
