<?php

namespace App\Http\Controllers;

use App\Services\SubscriptionServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\Customer;
use Stripe\Stripe;

class SubscriptionController extends Controller
{
    public function index(SubscriptionServices $services){
        $plans = $services->SubscriptionPlans();
        $user = Auth::user();
        $intent = $user->createSetupIntent();

        return view('subscription.index',
            compact('plans', 'user', 'intent'));
    }
}
