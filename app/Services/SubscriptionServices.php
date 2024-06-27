<?php

declare(strict_types=1);

namespace App\Services;
use Stripe\Stripe;

class SubscriptionServices
{
    public function SubscriptionPlans()
    {
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
        $plansraw = $stripe->plans->all();
        $plans = $plansraw->data;
        foreach($plans as $plan) {
            $prod = $stripe->products->retrieve(
                $plan->product,[]
            );
            $plan->product = $prod;
            if($plan->currency == 'usd')
                $plan->currency = '$';
        }

        return $plans;
    }
}
