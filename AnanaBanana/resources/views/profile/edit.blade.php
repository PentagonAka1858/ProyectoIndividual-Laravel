<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
            
            @if(!auth()->user()->latitud || !auth()->user()->longitud)
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <h2 class="text-lg font-medium text-gray-900">Weather</h2>
                    <p class="mt-1 text-sm text-gray-600">
                        You don't have a saved location.
                        <a href="#location" class="text-indigo-600 underline">Update your location</a> 
                        to see the weather.
                    </p>
                </div>
            </div>
            @elseif($weather)
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <h2 class="text-lg font-medium text-gray-900">Weather</h2>
                    <p class="mt-1 text-sm text-gray-600">Based on your location.</p>

                    @if($adverseWeather)
                        <div class="mt-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                            <strong>Adverse weather conditions</strong>
                            <p class="text-sm mt-1">Unfavourable conditions have been detected in your area. Caution is advised.</p>
                        </div>
                    @endif

                    <div class="mt-4 flex items-center gap-4">
                        <img src="https://openweathermap.org/img/wn/{{ $weather['weather'][0]['icon'] }}@2x.png" 
                            alt="{{ $weather['weather'][0]['description'] }}">
                        <div>
                            <p class="text-3xl font-bold text-gray-800">{{ round($weather['main']['temp']) }}°C</p>
                            <p class="text-gray-600 capitalize">{{ $weather['weather'][0]['description'] }}</p>
                            <p class="text-sm text-gray-500 mt-1">
                                Humidity: {{ $weather['main']['humidity'] }}% &nbsp;|&nbsp;
                                Wind: {{ round($weather['wind']['speed'] * 3.6) }} km/h
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            
            <div id="location" class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-location-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
