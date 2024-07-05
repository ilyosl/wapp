<div class="flex flex-col items-center justify-center min-h-screen text-gray-700 p-10 bg-gradient-to-br from-pink-200 via-purple-200 to-indigo-200 mt-3">
    <!-- Component Start -->
    <div class="w-full max-w-screen-sm bg-white p-10 rounded-xl ring-8 ring-white ring-opacity-40">
        <div class="flex justify-between">
            <div class="flex flex-col">
                <span class="text-6xl font-bold">{{$data['current']['temp_c']}}°C</span>
                <span class="font-semibold mt-1 text-gray-500">{{ $data['location']['region'] }}, {{ $data['location']['country'] }}</span>
            </div>
            <img src="{{ $data['current']['condition']['icon'] }}" class="h-24 w-24 fill-current text-yellow-400" >
{{--            <svg class="h-24 w-24 fill-current text-yellow-400" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M6.76 4.84l-1.8-1.79-1.41 1.41 1.79 1.79zM1 10.5h3v2H1zM11 .55h2V3.5h-2zm8.04 2.495l1.408 1.407-1.79 1.79-1.407-1.408zm-1.8 15.115l1.79 1.8 1.41-1.41-1.8-1.79zM20 10.5h3v2h-3zm-8-5c-3.31 0-6 2.69-6 6s2.69 6 6 6 6-2.69 6-6-2.69-6-6-6zm0 10c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm-1 4h2v2.95h-2zm-7.45-.96l1.41 1.41 1.79-1.8-1.41-1.41z"/></svg>--}}
        </div>
        <div class="flex justify-between mt-12">
            @foreach($data['forecast']['forecastday'][0]['hour'] as $key => $day)
                @if( in_array($key, [11, 13, 15, 17, 19]))
                    <div class="flex flex-col items-center">
                        <span class="font-semibold text-lg">{{ $day['temp_c'] }}°C</span>
                        <img class="w-16 fill-current text-gray-400" src="{{ $day['condition']['icon'] }}" />
                        <span class="font-semibold mt-1 text-sm">{{ $key }}:00</span>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</div>
