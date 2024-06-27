<div>
    <form wire:submit.prevent="submit">
        <div class="mb-4">
            <label for="cardholder-name" class="block text-gray-700 font-bold mb-2">Cardholder Name</label>
            <input id="cardholder-name" type="text" wire:model="cardholderName" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Jane Doe">
            @error('cardholderName') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>
        <div class="mb-4">
            <label for="card-number" class="block text-gray-700 font-bold mb-2">Card Number</label>
            <input id="card-number" type="text" wire:model="cardNumber" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="4242 4242 4242 4242">
        </div>
        <div class="mb-4 flex space-x-4">
            <div>
                <label for="expiry-month" class="block text-gray-700 font-bold mb-2">Expiry Month</label>
                <input id="expiry-month" type="text" wire:model="expiryMonth" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="12">
            </div>
            <div>
                <label for="expiry-year" class="block text-gray-700 font-bold mb-2">Expiry Year</label>
                <input id="expiry-year" type="text" wire:model="expiryYear" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="2024">
            </div>
        </div>
        <div class="mb-4">
            <label for="cvc" class="block text-gray-700 font-bold mb-2">CVC</label>
            <input id="cvc" type="text" wire:model="cvc" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="123">
        </div>
        @if($cardError)
            <div class="text-red-500 mb-4">{{ $cardError }}</div>
        @endif
        <button type="submit" class="w-full bg-blue-500 text-white font-bold py-2 rounded-lg hover:bg-blue-600">Submit Payment</button>
    </form>
</div>
