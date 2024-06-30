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
    public function processSubscription(Request $request)
    {
        $user = Auth::user();
        $paymentMethod = $request->input('payment_method');
        $user->createOrGetStripeCustomer();
        $user->addPaymentMethod($paymentMethod);
        $plan = $request->input('plan');
        try {
            $user->newSubscription('default', $plan)->trialDays(7)->create($paymentMethod, [
                'email' => $user->email
            ]);
        } catch (\Exception $e) {
            return back()->withErrors(['message' => 'Error creating subscription. ' . $e->getMessage()]);
        }
        return redirect()->route('dashboard');
    }
}
