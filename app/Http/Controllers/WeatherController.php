<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class WeatherController extends Controller
{
    public $locations = [
        'BINUS @Kemanggisan' => ['lat' => -6.201646453530158, 'lon' => 106.78222208589429],
        'BINUS @Alam Sutera' => ['lat' => -6.223032137332282, 'lon' => 106.64906698564837],
        'BINUS @Semarang' => ['lat' => -6.9474938345528, 'lon' => 110.38016475640173],
        'BINUS @Malang' => ['lat' => -7.9396293308822745, 'lon' => 112.68111949744234],
        'BINUS @Bandung' => ['lat' => -6.915237476458975, 'lon' => 107.59358245690747]
    ];

    public function showWeather(Request $request)
    {
        // Mendapatkan kota dari request, default 'Jakarta'
        $city = $request->input('city', 'BINUS @Kemanggisan');

        // Check if the city is supported
        if (!isset($this->locations[$city])) {
            return [
                'error' => 'Wilayah tidak didukung.',
                'rainData' => [],
                'message' => 'Kota tidak tersedia.',
            ];
        }

        // Fetch weather data with caching
        $data = Cache::remember("weather_{$city}", now()->addMinutes(10), function () use ($city) {
            $response = Http::get(env('WEATHER_API_URL'), [
                'lat' => $this->locations[$city]['lat'],
                'lon' => $this->locations[$city]['lon'],
                'appid' => env('WEATHER_API_KEY'),
                'units' => 'metric',
            ]);

            if ($response->successful()) {
                $forecast = $response->json();
                $rainData = [];

                // Loop to extract rain data
                foreach ($forecast['list'] as $forecastData) {
                    for ($i = 0; $i < 3; $i++) {
                        if (isset($forecastData['rain']['3h']) && $forecastData['rain']['3h'] > 0) {
                            $rainPerHour = $forecastData['rain']['3h'] / 3;
                            $rainData[] = [
                                'time' => \Carbon\Carbon::parse($forecastData['dt_txt'])->addHours($i)->format('Y-m-d H:i'),
                                'rain_mm' => $rainPerHour,
                            ];
                        }
                    }
                }

                // Return rain data or a message
                return [
                    'rainData' => $rainData,
                    'message' => count($rainData) > 0 ? '' : 'Tidak ada hujan yang diprediksi dalam waktu dekat.',
                ];
            } else {
                // Log the error and return a fallback message
                Log::error("Error from Weather API for {$city}: {$response->status()} - {$response->body()}");
                return [
                    'error' => 'Gagal mengambil data cuaca.',
                    'rainData' => [],
                    'message' => 'Tidak dapat memuat data cuaca.',
                ];
            }
        });

        // Paginate rainData
        $rainData = collect($data['rainData']);
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 10; // Adjust number of results per page
        $paginatedRainData = new LengthAwarePaginator(
            $rainData->forPage($currentPage, $perPage)->values(),
            $rainData->count(),
            $perPage,
            $currentPage,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        return view('landing', [
            'city' => $city,
            'rainData' => $paginatedRainData,
            'message' => $data['message'] ?? null,
        ]);
    }
}
