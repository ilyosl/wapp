<x-app-layout>
    <script src="https://js.stripe.com/v3/"></script>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Subscription page') }}
        </h2>
    </x-slot>
    <div class="bg-gray-100">
        <div class="max-w-screen-lg mx-auto p-4">
            <div class="flex flex-col sm:flex-row justify-center items-center gap-4">
                @foreach($plans as $plan)
                <div class="bg-white shadow-lg rounded-lg p-6">
                    <h2 class="text-2xl font-semibold text-gray-800">{{$plan->product->name}} plan</h2>
                    <p class="text-gray-600">
                        @if($plan->interval == 'year')
                            For business users
                        @else
                            Perfect for starters
                        @endif
                    </p>
                    <div class="mt-4">
                        <span class="text-4xl font-bold {{ $plan->interval == 'month' ? 'text-indigo-500' : 'text-green-500' }} ">{{$plan->currency}}{{$plan->amount/100}}</span>
                        <span class="text-gray-600">/{{$plan->interval}}</span>
                    </div>
                    <ul class="mt-4 space-y-2">
                        <li class="flex items-center">
                            <svg class="w-6 h-6 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M5 13l4 4L19 7"></path></svg>
                            <span class="text-gray-700">With trial 7 days</span>
                        </li>
                        @if($plan->interval == 'year')
                            <li class="flex items-center">
                                <svg class="w-6 h-6 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M5 13l4 4L19 7"></path></svg>
                                <span class="text-gray-700">More save your money</span>
                            </li>
                        @endif
                    </ul>
                    <a href="#" class="block mt-6 text-center text-white {{ $plan->interval =='month' ? 'bg-indigo-500 hover:bg-indigo-600' : 'bg-green-500 hover:bg-green-600' }} py-2 rounded-full" onclick="showModal('{{ $plan->id }}')">Choose Plan</a>
                </div>
                @endforeach
            </div>
        </div>
        <!-- Payment Form Modal -->
        <div id="payment-form-modal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center">
            <div class="bg-white rounded-lg p-8 shadow-lg max-w-md w-full">
                <h2 class="text-2xl font-semibold text-gray-800 mb-6">Complete Your Payment</h2>
                <form id="payment-form" method="POST" action="{{ route('subscription.confirm') }}">
                    @csrf
                    <input type="hidden" name="plan" id="plan_id">
                    <label for="card-element" class="mb-4">Credit or debit card</label>
                    <div id="card-element" class="mb-6 mt-3">
                        <!-- Stripe.js injects the Card Element here -->
                    </div>
                    <!-- Used to display form errors. -->
                    <div id="card-errors" role="alert"></div>
                    <button id="submit-button" data-secret="{{ $intent->client_secret }}" class="bg-blue-500 self-center text-white py-2 px-4 rounded hover:bg-blue-600" type="submit">Submit Payment</button>
                </form>
                <button class="mt-4 text-gray-600 hover:text-gray-800" onclick="closeModal()">Cancel</button>
            </div>
        </div>
        <script>
            var stripe = Stripe('{{ env('STRIPE_KEY') }}');
            var elements = stripe.elements();
            var cardElement = elements.create('card');
            cardElement.mount('#card-element')
            function showModal(id) {
                console.log(id)
                document.getElementById('plan_id').value = id;
                document.getElementById('payment-form-modal').classList.remove('hidden');
            }
            function closeModal() {
                document.getElementById('payment-form-modal').classList.add('hidden');
            }
            cardElement.addEventListener('change', function(event) {
                var displayError = document.getElementById('card-errors');
                if (event.error) {
                    displayError.textContent = event.error.message;
                } else {
                    displayError.textContent = '';
                }
            });

            const cardButton = document.getElementById('submit-button');
            const clientSecret = cardButton.dataset.secret;
            cardButton.addEventListener('click', async (e) => {
                console.log("attempting");
                const { setupIntent, error } = await stripe.confirmCardSetup(
                    clientSecret, {
                        payment_method: {
                            card: cardElement,
                        }
                    }
                );
                if (error) {
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = error.message;
                } else {
                    paymentMethodHandler(setupIntent.payment_method);
                }
            });
            function paymentMethodHandler(payment_method) {
                var form = document.getElementById('payment-form');
                var hiddenInput = document.createElement('input');
                hiddenInput.setAttribute('type', 'hidden');
                hiddenInput.setAttribute('name', 'payment_method');
                hiddenInput.setAttribute('value', payment_method);
                form.appendChild(hiddenInput);
                form.submit();
            }
        </script>

    </div>
</x-app-layout>
