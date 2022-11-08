<?php

namespace App\Traits\Observers\Api\v1\Badges;

use App\Models\{Badge, ServiceEvent};
use Illuminate\Support\Facades\Log;
trait HasServiceEventBadges
{
    /**
     * Name: Penny Club
     * Description: First SE completed
     * @return void
     */
    protected function badgePennyClub(ServiceEvent $service_event)
    {
        if (!empty($service_event->end_at)) {
            $badge = Badge::whereName('Penny Club')->first();
            $user = $service_event->user;
            if ($user->service_events->count() > 1 && !empty($badge)) {
                $user->badges()->syncWithoutDetaching($badge->id);
            }
        }
    }

    /**
     * Name: Quarterback
     * Description: 25 SEs completed
     * @return void
     */
    protected function badgeQuarterBack(ServiceEvent $service_event)
    {
        if (!empty($service_event->end_at)) {
            $badge = Badge::whereName('Quarterback')->first();
            $user = $service_event->user;
            if ($user->service_events->count() > 25 && !empty($badge)) {
                $user->badges()->syncWithoutDetaching($badge->id);
            }
        }
    }

    /**
     * Name: Benjamin Award
     * Description: 100 SEs completed
     * @return void
     */
    protected function badgeBenjaminAward(ServiceEvent $service_event)
    {
        if (!empty($service_event->end_at)) {
            $badge = Badge::whereName('Benjamin Award')->first();
            $user = $service_event->user;
            if ($user->service_events->count() > 100 && !empty($badge)) {
                $user->badges()->syncWithoutDetaching($badge->id);
            }
        }
    }

    /**
     * Name: Pro Class
     * Description: 250 SEs completed
     * @return void
     */
    protected function badgeProClass(ServiceEvent $service_event)
    {
        if (!empty($service_event->end_at)) {
            $badge = Badge::whereName('Pro Class')->first();
            $user = $service_event->user;
            if ($user->service_events->count() > 250 && !empty($badge)) {
                $user->badges()->syncWithoutDetaching($badge->id);
            }
        }
    }

    /**
     * Name: Seasoned Veteran
     * Description: 250 SEs completed
     * @return void
     */
    protected function badgeSeasonedVeteran(ServiceEvent $service_event)
    {
        if (!empty($service_event->end_at)) {
            $badge = Badge::whereName('Seasoned Veteran')->first();
            $user = $service_event->user;
            if ($user->service_events->count() > 500 && !empty($badge)) {
                $user->badges()->syncWithoutDetaching($badge->id);
            }
        }
    }

    /**
     * Name: MINI-ME
     * Description: SE completed on Asset <2 lbs
     * @return void
     */
    protected function badgeMiniMe(ServiceEvent $service_event)
    {
        if (!empty($service_event->end_at)) {
            Log::info('test');
            $equipmentAssets = $service_event->serviced_equipment_assets;
            $badge = Badge::whereName('MINI-ME')->first();
            $user = $service_event->user;

            if (!empty($equipmentAssets) && !empty($badge)) {
                $equipmentAssets->each(function ($asset, $key) use ($user, $badge) {
                    if ($asset->factory_field_charge < 2) {
                        $user->badges()->syncWithoutDetaching($badge->id);
                    }
                });
            }
        }
    }

    /**
     * Name: Sweet Spot
     * Description: SE completed on Asset 2-10 lbs
     * @return void
     */
    protected function badgeSweetSpot(ServiceEvent $service_event)
    {
        if (!empty($service_event->end_at)) {
            $equipmentAssets = $service_event->serviced_equipment_assets;
            $badge = Badge::whereName('Sweet Spot')->first();
            $user = $service_event->user;

            if (!empty($equipmentAssets) && !empty($badge)) {
                $equipmentAssets->each(function ($asset, $key) use ($user, $badge) {
                    if ($asset->factory_field_charge >= 2 && $asset->factory_field_charge <= 10) {
                        $user->badges()->syncWithoutDetaching($badge->id);
                    }
                });
            }
        }
    }

    /**
     * Name: God Father
     * Description: SE completed on Asset 11-50 lbs
     * @return void
     */
    protected function badgeGodFather(ServiceEvent $service_event)
    {
        if (!empty($service_event->end_at)) {
            $equipmentAssets = $service_event->serviced_equipment_assets;
            $badge = Badge::whereName('God Father')->first();
            $user = $service_event->user;

            if (!empty($equipmentAssets) && !empty($badge)) {
                $equipmentAssets->each(function ($asset, $key) use ($user, $badge) {
                    if ($asset->factory_field_charge >= 11 && $asset->factory_field_charge <= 50) {
                        $user->badges()->syncWithoutDetaching($badge->id);
                    }
                });
            }
        }
    }

    /**
     * Name: Body Builder
     * Description: SE completed on Asset 51-250 lbs
     * @return void
     */
    protected function badgeBodyBuilder(ServiceEvent $service_event)
    {
        if (!empty($service_event->end_at)) {
            $equipmentAssets = $service_event->serviced_equipment_assets;
            $badge = Badge::whereName('Body Builder')->first();
            $user = $service_event->user;

            if (!empty($equipmentAssets) && !empty($badge)) {
                $equipmentAssets->each(function ($asset, $key) use ($user, $badge) {
                    if ($asset->factory_field_charge >= 51 && $asset->factory_field_charge <= 250) {
                        $user->badges()->syncWithoutDetaching($badge->id);
                    }
                });
            }
        }
    }

    /**
     * Name: Heavy Lifter
     * Description: SE completed on Asset 251-1,000 lbs
     * @return void
     */
    protected function badgeHeavyLifter(ServiceEvent $service_event)
    {
        if (!empty($service_event->end_at)) {
            $equipmentAssets = $service_event->serviced_equipment_assets;
            $badge = Badge::whereName('Heavy Lifter')->first();
            $user = $service_event->user;

            if (!empty($equipmentAssets) && !empty($badge)) {
                $equipmentAssets->each(function ($asset, $key) use ($user, $badge) {
                    if ($asset->factory_field_charge >= 251 && $asset->factory_field_charge <= 1000) {
                        $user->badges()->syncWithoutDetaching($badge->id);
                    }
                });
            }
        }
    }

    /**
     * Name: Beast
     * Description: SE completed on Asset 1,001-10,000 lbs
     * @return void
     */
    protected function badgeBeast(ServiceEvent $service_event)
    {
        if (!empty($service_event->end_at)) {
            $equipmentAssets = $service_event->serviced_equipment_assets;
            $badge = Badge::whereName('Beast')->first();
            $user = $service_event->user;

            if (!empty($equipmentAssets) && !empty($badge)) {
                $equipmentAssets->each(function ($asset, $key) use ($user, $badge) {
                    if ($asset->factory_field_charge >= 1001 && $asset->factory_field_charge <= 10000) {
                        $user->badges()->syncWithoutDetaching($badge->id);
                    }
                });
            }
        }
    }

    /**
     * Name: Leviathon
     * Description: SE completed on Asset >10,000 lbs
     * @return void
     */
    protected function badgeLeviathon(ServiceEvent $service_event)
    {
        if (!empty($service_event->end_at)) {
            $equipmentAssets = $service_event->serviced_equipment_assets;
            $badge = Badge::whereName('Leviathon')->first();
            $user = $service_event->user;

            if (!empty($equipmentAssets) && !empty($badge)) {
                $equipmentAssets->each(function ($asset, $key) use ($user, $badge) {
                    if ($asset->factory_field_charge > 10000) {
                        $user->badges()->syncWithoutDetaching($badge->id);
                    }
                });
            }
        }
    }

    /**
     * Name: Minotaur
     * Description: Qty of Assets tied to 1 SE >= 5 < 20
     * @return void
     */
    protected function badgeMinotaur(ServiceEvent $service_event)
    {
        if (!empty($service_event->end_at)) {
            $equipmentAssets = $service_event->serviced_equipment_assets;
            $badge = Badge::whereName('Minotaur')->first();
            $user = $service_event->user;

            if (!empty($equipmentAssets) && !empty($badge)) {
                if ($equipmentAssets->count() >= 5 && $equipmentAssets->count() < 20) {
                    $user->badges()->syncWithoutDetaching($badge->id);
                }
            }
        }
    }

    /**
     * Name: Griffin
     * Description: Qty of Assets tied to 1 SE >= 20 < 100
     * @return void
     */
    protected function badgeGriffin(ServiceEvent $service_event)
    {
        if (!empty($service_event->end_at)) {
            $equipmentAssets = $service_event->serviced_equipment_assets;
            $badge = Badge::whereName('Griffin')->first();
            $user = $service_event->user;

            if (!empty($equipmentAssets) && !empty($badge)) {
                if ($equipmentAssets->count() >= 20 && $equipmentAssets->count() < 100) {
                    $user->badges()->syncWithoutDetaching($badge->id);
                }
            }
        }
    }

    /**
     * Name: Centaur
     * Description: Qty of Assets tied to 1 SE >= 100 < 250
     * @return void
     */
    protected function badgeCentaur(ServiceEvent $service_event)
    {
        if (!empty($service_event->end_at)) {
            $equipmentAssets = $service_event->serviced_equipment_assets;
            $badge = Badge::whereName('Centaur')->first();
            $user = $service_event->user;

            if (!empty($equipmentAssets) && !empty($badge)) {
                if ($equipmentAssets->count() >= 100 && $equipmentAssets->count() < 250) {
                    $user->badges()->syncWithoutDetaching($badge->id);
                }
            }
        }
    }


    /**
     * Name: Phoenix
     * Description: Qty of Assets tied to 1 SE >= 250
     * @return void
     */
    protected function badgePhoenix(ServiceEvent $service_event)
    {
        if (!empty($service_event->end_at)) {
            $equipmentAssets = $service_event->serviced_equipment_assets;
            $badge = Badge::whereName('Phoenix')->first();
            $user = $service_event->user;

            if (!empty($equipmentAssets) && !empty($badge)) {
                if ($equipmentAssets->count() >= 250) {
                    $user->badges()->syncWithoutDetaching($badge->id);
                }
            }
        }
    }


    protected function handleBadges(ServiceEvent $service_event)
    {
        $this->badgePennyClub($service_event);
        $this->badgeQuarterBack($service_event);
        $this->badgeBenjaminAward($service_event);
        $this->badgeProClass($service_event);
        $this->badgeSeasonedVeteran($service_event);

        $this->badgeMiniMe($service_event);
        $this->badgeSweetSpot($service_event);
        $this->badgeGodFather($service_event);
        $this->badgeBodyBuilder($service_event);
        $this->badgeHeavyLifter($service_event);
        $this->badgeBeast($service_event);
        $this->badgeLeviathon($service_event);

        $this->badgeMinotaur($service_event);
        $this->badgeGriffin($service_event);
        $this->badgeCentaur($service_event);
        $this->badgePhoenix($service_event);

    }
}
