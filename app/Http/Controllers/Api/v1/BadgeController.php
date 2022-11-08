<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\Badge\{ IndexBadge, ShowBadge, StoreBadge, UpdateBadge, DestroyBadge };
use App\Models\{User,Badge};
use App\Traits\Controllers\Api\v1\HasControllerHelpers;

class BadgeController extends Controller
{
    use HasControllerHelpers;

    /**
     * Display a listing of the badges.
     *
     * @param  \App\Http\Requests\Api\v1\Badge\IndexBadge  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IndexBadge $request)
    {
        $fields = $request->validated();
        $badges = Badge::select();

        return $this->filtered($badges, $fields);
    }

    /**
     * Display a listing of the user's badges.
     *
     * @param  \App\Http\Requests\Api\v1\Badge\IndexBadge  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function indexUserBadges(User $user, IndexBadge $request)
    {
        $fields = $request->validated();
        $badges = Badge::select();

        $user_badges = $this->filtered($badges, $fields);

        $user_badges->map(function ($badge, $key) use($user) {
            $badge->is_earned = $badge->users->contains($user->id);
        });

        return $user_badges;
    }

    /**
     * Display the specified badge.
     *
     * @param  \App\Models\Badge  $badge
     * @param  \App\Http\Requests\Api\v1\Badge\ShowBadge  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Badge $badge, ShowBadge $request)
    {
        return $badge;
    }

    /**
     * Store a newly created badge in storage.
     *
     * @param  \App\Http\Requests\Api\v1\Badge\StoreBadge  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBadge $request)
    {
        $fields = $request->validated();

        return Badge::create($fields)->fresh();
    }

    /**
     * Update the specified badge in storage.
     *
     * @param  \App\Models\Badge  $badge
     * @param  \App\Http\Requests\Api\v1\Badge\UpdateBadge  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Badge $badge, UpdateBadge $request)
    {
        $fields = $request->validated();

        $badge->fill($fields);
        $badge->save();

        return $badge;
    }

    /**
     * Remove the specified badge from storage.
     *
     * @param  \App\Models\Badge  $badge
     * @param  \App\Http\Requests\Api\v1\Badge\DestroyBadge  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Badge $badge, DestroyBadge $request)
    {
        $badge->delete();
        return response()->json(null, 204);
    }
}
