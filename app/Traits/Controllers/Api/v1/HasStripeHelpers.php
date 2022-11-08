<?php

namespace App\Traits\Controllers\Api\v1;

use App\Helpers\QueryFilterHelper;
use Illuminate\Support\Str;
use App\Models\{EquipmentAsset, CylinderAsset, ServiceEvent, Site};

use App\Models\Subscription;
use Laravel\Cashier\Cashier;
use Stripe\Stripe;

trait HasStripeHelpers
{
    protected function retrievePlans() {
       $key = config('services.stripe.secret');
       $stripeClient = new \Stripe\StripeClient($key);
       $plansraw = $stripeClient->plans->all();
       $plans = $plansraw->data;

       foreach($plans as $plan) {
           $prod = $stripeClient->products->retrieve(
               $plan->product,[]
           );
           $plan->product = $prod;
       }
       return $plans;
   }
}
