<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\GoalCategory\{ IndexGoalCategory, ShowGoalCategory, StoreGoalCategory, UpdateGoalCategory, DestroyGoalCategory };
use App\Models\GoalCategory;
use App\Traits\Controllers\Api\v1\HasControllerHelpers;

class GoalCategoryController extends Controller
{
    use HasControllerHelpers;

    /**
     * Display a listing of the goal_categories.
     * 
     * @param  \App\Http\Requests\Api\v1\GoalCategory\IndexGoalCategory  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IndexGoalCategory $request)
    {
        $fields = $request->validated();
        $goal_categories = GoalCategory::select();

        return $this->filtered($goal_categories, $fields);
    }

    /**
     * Display the specified goal_category.
     * 
     * @param  \App\Models\GoalCategory  $goal_category
     * @param  \App\Http\Requests\Api\v1\GoalCategory\ShowGoalCategory  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function show(GoalCategory $goal_category, ShowGoalCategory $request)
    {
        return $goal_category;
    }

    /**
     * Store a newly created goal_category in storage.
     * 
     * @param  \App\Http\Requests\Api\v1\GoalCategory\StoreGoalCategory  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGoalCategory $request)
    {
        $fields = $request->validated();

        return GoalCategory::create($fields)->fresh();
    }

    /**
     * Update the specified goal_category in storage.
     * 
     * @param  \App\Models\GoalCategory  $goal_category
     * @param  \App\Http\Requests\Api\v1\GoalCategory\UpdateGoalCategory  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(GoalCategory $goal_category, UpdateGoalCategory $request)
    {
        $fields = $request->validated();

        $goal_category->fill($fields);
        $goal_category->save();

        return $goal_category;
    }

    /**
     * Remove the specified goal_category from storage.
     * 
     * @param  \App\Models\GoalCategory  $goal_category
     * @param  \App\Http\Requests\Api\v1\GoalCategory\DestroyGoalCategory  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(GoalCategory $goal_category, DestroyGoalCategory $request)
    {
        $goal_category->delete();
        return response()->json(null, 204);
    }
}
