<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class WeatherService
{
    public function getWeather(float $lat, float $lon): ?array
    {
        $response = Http::get('https://api.openweathermap.org/data/2.5/weather', [
            'lat'   => $lat,
            'lon'   => $lon,
            'appid' => config('app.openweather_key'),
            'units' => 'metric',
            'lang'  => 'en',
        ]);

        if ($response->successful()) {
            return $response->json();
        }

        return null;
    }

    public function isAdverseWeather(array $weather): bool
    {
        $adverseConditions = ['Rain', 'Snow', 'Thunderstorm', 'Drizzle', 'Tornado', 'Squall'];
        $main = $weather['weather'][0]['main'] ?? '';

        return in_array($main, $adverseConditions);
    }
}
