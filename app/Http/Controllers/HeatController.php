<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class HeatController extends Controller
{
    protected $locations = [
        'Jakarta' => ['lat' => -6.2146, 'lon' => 106.8451],
        'Tangerang' => ['lat' => -6.1781, 'lon' => 106.63],
    ];

    public function showHeat(Request $request)
    {
        // Mendapatkan kota dari request, default 'Jakarta'
        $city = $request->input('city', 'Jakarta');

        if (!isset($this->locations[$city])) {
            return response()->json(['error' => 'Wilayah tidak didukung.'], 400);
        }

        // Mengambil data cuaca, dengan cache selama 10 menit
        $data = Cache::remember("weather_{$city}", now()->addMinutes(10), function () use ($city) {
            // Make the API request to the weather service
            $response = Http::get(('https://api.openweathermap.org/data/2.5/weather'), [
                'lat' => $this->locations[$city]['lat'],
                'lon' => $this->locations[$city]['lon'],
                'appid' => env('WEATHER_API_KEY'),
                'units' => 'metric',
            ]);

            // Log the response for debugging purposes
            Log::info("Weather API Response for {$city}: ", $response->json());

            if ($response->successful()) {
                $currentWeather = $response->json();
            
                // Validasi keberadaan key 'main' dan 'dt'
                if (!isset($currentWeather['main']) || !isset($currentWeather['dt'])) {
                    Log::error("Missing 'main' or 'dt' key in API response for {$city}");
                    return ['error' => 'Data cuaca tidak tersedia.'];
                }
            
                // Ambang batas untuk mendeteksi panas
                $heatThreshold = 30;
            
                // Ambil data suhu, feels_like, dan waktu
                $temperature = $currentWeather['main']['temp'] ?? 0;
                $feelsLike = $currentWeather['main']['feels_like'] ?? 0;
            
                // Konversi waktu dari UNIX timestamp
                $time = $currentWeather['dt'];
                $formattedTime = \Carbon\Carbon::createFromTimestamp($time)->format('Y-m-d H:i:s');
            
                // Periksa apakah suhu melebihi ambang batas
                if ($temperature >= $heatThreshold || $feelsLike >= $heatThreshold) {
                    return [
                        'isHot' => true,
                        'temperature' => $temperature,
                        'feels_like' => $feelsLike,
                        'time' => $formattedTime,
                        'message' => 'Cuaca saat ini panas.',
                    ];
                } else {
                    return [
                        'isHot' => false,
                        'temperature' => $temperature,
                        'feels_like' => $feelsLike,
                        'time' => $formattedTime,
                        'message' => 'Cuaca saat ini tidak terlalu panas.',
                    ];
                }
            } else {
                // Log error jika API gagal
                Log::error("Error from Weather API for {$city}: {$response->status()} - {$response->body()}");
                return ['error' => 'Gagal mengambil data cuaca.'];
            }
        });

        // Periksa jika ada error dalam data
        if (isset($data['error'])) {
            return response()->json(['error' => $data['error']], 400);
        }

        // Return the view with data
        return view('heat', [
            'isHot' => $data['isHot'] ?? false,
            'temperature' => $data['temperature'] ?? null,
            'time' => $data['time'] ?? null,
            'city' => $city,
            'message' => $data['message'] ?? ''
        ]);
    }
}