<?php

namespace App\Traits\Observers\Api\v1\Badges;

use App\Models\{Badge, User};
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

trait HasAppUsageBadges
{
    /**
     * Name: Weekling
     * Description: Open the app every day for 7 consecutive days
     * @return void
     */
    protected function badgeWeekling(User $user)
    {
        $badge = Badge::whereName('Weekling')->first();


        if ($user->appUsageStreak() >= 6) {    //Needs to be -1 of the day count
            $user->badges()->syncWithoutDetaching($badge->id);
        }
    }

    /**
     * Name: Enthusiast
     * Description: Open the app every day for 30 consecutive days
     * @return void
     */
    protected function badgeEnthusiast(User $user)
    {
        $badge = Badge::whereName('Enthusiast')->first();

        if ($user->appUsageStreak() >= 29) {    //Needs to be -1 of the day count
            $user->badges()->syncWithoutDetaching($badge->id);
        }
    }

    /**
     * Name: Fanatic
     * Description: Open the app every day for 100 consecutive days
     * @return void
     */
    protected function badgeFanatic(User $user)
    {

        $badge = Badge::whereName('Fanatic')->first();

        if ($user->appUsageStreak() >= 99) {    //Needs to be -1 of the day count
            $user->badges()->syncWithoutDetaching($badge->id);
        }
    }

    /**
     * Name: Yearling
     * Description: Active user for one year with at least 1000 points
     * @return void
     */
    protected function badgeYearling(User $user)
    {
        $badge = Badge::whereName('Yearling')->first();


        if (
            $user->app_usages()->whereDate('created_at', "<=", DB::raw('DATE_ADD(CURDATE(), INTERVAL -365 DAY)'))->exists() && $user->total_points > 1000
        ) {
            $user->badges()->syncWithoutDetaching($badge->id);
        }
    }

    protected function handleBadges(User $user)
    {
        $this->badgeWeekling($user);
        $this->badgeEnthusiast($user);
        $this->badgeFanatic($user);
        $this->badgeYearling($user);
    }
}
