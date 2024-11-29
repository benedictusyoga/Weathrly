<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class WeatherController extends Controller
{
    protected $locations = [
        'Jakarta' => ['lat' => -6.2146, 'lon' => 106.8451],
        'Tangerang' => ['lat' => -6.1781, 'lon' => 106.63],
    ];

    public function showWeather(Request $request)
    {
        // Mendapatkan kota dari request, default 'Jakarta'
        $city = $request->input('city', 'Jakarta');

        if (!isset($this->locations[$city])) {
            return response()->json(['error' => 'Wilayah tidak didukung.'], 400);
        }

        // Mengambil data cuaca, dengan cache selama 10 menit
        $data = Cache::remember("weather_{$city}", now()->addMinutes(10), function () use ($city) {
            // Make the API request to the weather service
            $response = Http::get(env('WEATHER_API_URL'), [
                'lat' => $this->locations[$city]['lat'],
                'lon' => $this->locations[$city]['lon'],
                'appid' => env('WEATHER_API_KEY'),
                'units' => 'metric',
            ]);

            // Log the response for debugging purposes
            Log::info("Weather API Response for {$city}: ", $response->json());

            if ($response->successful()) {
                $forecast = $response->json();
                $rainData = [];

                // Loop untuk memeriksa data hujan di setiap interval
                foreach ($forecast['list'] as $forecastData) {
                    // Each forecast entry represents 3 hours, so we split it into hourly intervals
                    for ($i = 0; $i < 3; $i++) {
                        $rainKey = 'rain_' . $i;
                        // Check if rain data exists and if it's greater than 0 for each hour in the 3-hour block
                        if (isset($forecastData['rain']) && isset($forecastData['rain']['3h']) && $forecastData['rain']['3h'] > 0) {
                            $rainPerHour = $forecastData['rain']['3h'] / 3;
                            $rainData[] = [
                                'time' => \Carbon\Carbon::parse($forecastData['dt_txt'])->addHours($i)->format('Y-m-d H:i'),
                                'rain_mm' => $rainPerHour,
                            ];
                        }
                    }
                }

                // Jika ada data hujan, kembalikan hasil
                if (count($rainData) > 0) {
                    return ['rainData' => $rainData];
                } else {
                    return ['message' => 'Tidak ada hujan yang diprediksi dalam waktu dekat.'];
                }
            } else {
                // Log the error response from the API
                Log::error("Error from Weather API for {$city}: {$response->status()} - {$response->body()}");
                return ['error' => 'Gagal mengambil data cuaca.'];
            }
        });

        // Periksa jika ada error dalam data
        if (isset($data['error'])) {
            return response()->json(['error' => $data['error']], 400);
        }

        // Return the view with data
        return view('weather', [
            'rainData' => $data['rainData'] ?? [],
            'city' => $city,
            'message' => $data['message'] ?? ''
        ]);
    }
}
