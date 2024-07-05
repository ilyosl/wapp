<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Weather alert info') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if($user->onTrial('default'))
                        You'll get plan, Your trail day will expire on {{ $user->trialEndsAt('default')}}
                        @livewire('weather-dashboard',['data'=>$data])
                    @else
                        You have to get <a href="{{ route('subscription.plans') }}" class="text-indigo-500">subscription plan</a>
                    @endif
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
