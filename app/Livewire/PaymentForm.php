<?php

namespace App\Livewire;

use Livewire\Component;
use Stripe\Stripe;
use Stripe\PaymentMethod;

class PaymentForm extends Component
{
    public $cardholderName;
    public $cardNumber;
    public $expiryMonth;
    public $expiryYear;
    public $cvc;
    public $cardError;

    protected $rules = [
        'cardholderName' => 'required|string',
    ];

    public function submit()
    {
        $this->validate();

        try {
            Stripe::setApiKey(env('STRIPE_SECRET'));

            $paymentMethod = PaymentMethod::create([
                'card' => [
                    'number' => $this->cardNumber,
                    'exp_month' => $this->expiryMonth,
                    'exp_year' => $this->expiryYear,
                    'cvc' => $this->cvc,
                ],
                'billing_details' => [
                    'name' => $this->cardholderName,
                ],
            ]);

           dd($paymentMethod);
        } catch (\Exception $e) {
            $this->cardError = $e->getMessage();
        }
    }

    public function render()
    {
        return view('livewire.payment-form');
    }
}
