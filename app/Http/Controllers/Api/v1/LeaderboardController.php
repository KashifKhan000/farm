<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\Leaderboard\{ IndexLeaderboard, ShowLeaderboard, StoreLeaderboard, UpdateLeaderboard, DestroyLeaderboard };
use App\Models\User;
use App\Traits\Controllers\Api\v1\HasControllerHelpers;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

class LeaderboardController extends Controller
{
    use HasControllerHelpers;

    /**
     * Display a listing of the leaderboards.
     *
     * @param  \App\Http\Requests\Api\v1\Leaderboard\IndexLeaderboard  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(IndexLeaderboard $request)
    {
        $fields = $request->validated();

        // return $fields;
        $topRankingsPoints = User::whereHas('points', function (Builder $query) use ($fields) {
            if (!empty($fields['end_at'])) {
                $query->whereDate('point_user.created_at', '<=', Carbon::parse($fields['end_at'])->endOfDay()->toDateTimeString());
            }
        })->get()->each->append('total_points')->sortByDesc('total_points')->take('15');


        $topRankingsBadges = User::withCount('badges')->whereHas('badges', function (Builder $query) use ($fields) {
            if (!empty($fields['end_at'])) {
                $query->where('badge_user.created_at', '<=', Carbon::parse($fields['end_at'])->endOfDay()->toDateTimeString());
            }
        })->get()->sortByDesc('badges_count')->take('15');

        return [
            'points' => $topRankingsPoints,
            'badges' => $topRankingsBadges,
        ];
    }
}
