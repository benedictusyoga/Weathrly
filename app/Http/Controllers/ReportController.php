<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        if (!Auth::check()) {
            // Redirect to login if not authenticated
            return redirect()->route('login')->with('error', 'You must log in to access this page.');
        }
        // Ambil keyword dari input pencarian
        $search = $request->input('search');

        // Filter laporan berdasarkan title atau location_name
        $reports = Report::when($search, function ($query, $search) {
            return $query->where('title', 'LIKE', "%{$search}%")
                ->orWhere('location_name', 'LIKE', "%{$search}%");
        })->paginate(10);

        // Kembalikan view dengan data laporan
        return view('reports.index', compact('reports'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!Auth::check()) {
            // Redirect to login if not authenticated
            return redirect()->route('login')->with('error', 'You must log in to access this page.');
        }
        return view('report');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!Auth::check()) {
            // Redirect to login if not authenticated
            return redirect()->route('login')->with('error', 'You must log in to access this page.');
        }
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg',
        ]);

        $path = null;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('reports/images', 's3');
        }

        // Menyimpan laporan ke database
        $report = new Report();
        $report->title = $request->input('title');
        $report->description = $request->input('description');
        $report->location = $request->input('location');
        $locationParts = explode(',', $validated['location']);
        $latitude = trim($locationParts[0]);
        $longitude = trim($locationParts[1]);
        $locationName = $this->getLocationName($latitude, $longitude);
        $report->location_name = $locationName;
        $report->image_path = $path; // Save path to the image
        $report->save();

        // Arahkan ke halaman daftar laporan setelah berhasil disubmit
        return redirect()->route('reports.index')->with('success', 'Laporan berhasil dikirim!');
    }


    /**
     * Display the specified resource.
     */
    public function show(Report $report)
    {
        if (!Auth::check()) {
            // Redirect to login if not authenticated
            return redirect()->route('login')->with('error', 'You must log in to access this page.');
        }
        return view('reports.show', compact('report'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Report $report)
    {
        if (!Auth::check()) {
            // Redirect to login if not authenticated
            return redirect()->route('login')->with('error', 'You must log in to access this page.');
        }
        return view('reports.edit', compact('report'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Report $report)
    {
        if (!Auth::check()) {
            // Redirect to login if not authenticated
            return redirect()->route('login')->with('error', 'You must log in to access this page.');
        }
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Update image jika ada
        if ($request->hasFile('image')) {
            if ($report->image_path && $report->image_path !== 'reports/images/default-image.png') {
                \Storage::disk('s3')->delete($report->image_path);
            }
            $path = $request->file('image')->store('reports/images', 's3');
            $report->image_path = $path;
        }

        $locationParts = explode(',', $validated['location']);
        $latitude = trim($locationParts[0]);
        $longitude = trim($locationParts[1]);
        $locationName = $this->getLocationName($latitude, $longitude);

        // Update data lainnya
        $report->title = $validated['title'];
        $report->description = $validated['description'];
        $report->location = $validated['location'];
        $report->location_name = $locationName;
        $report->save();
        $report->update($validated);

        return redirect()->route('reports.index')->with('success', 'Laporan berhasil diperbarui!');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Report $report)
    {
        if (!Auth::check()) {
            // Redirect to login if not authenticated
            return redirect()->route('login')->with('error', 'You must log in to access this page.');
        }

        if ($report->image_path && $report->image_path !== 'reports/images/default-image.png') {
            \Storage::disk('s3')->delete($report->image_path);
        }
        $report->delete();
        return redirect()->route('reports.index')->with('success', 'Laporan berhasil dihapus!');
    }

    private function getLocationName($latitude, $longitude)
    {
        if (!Auth::check()) {
            // Redirect to login if not authenticated
            return redirect()->route('login')->with('error', 'You must log in to access this page.');
        }
        try {
            // URL Reverse Geocoding Nominatim
            $url = "https://nominatim.openstreetmap.org/reverse?lat={$latitude}&lon={$longitude}&format=json";

            // Send HTTP GET request
            $response = Http::withHeaders([
                'User-Agent' => 'Weathrly (revaldoapryan@gmail.com)', // Update this as needed
            ])->get($url);

            // Check if the response is successful and parse the location name
            if ($response->successful() && isset($response['display_name'])) {
                return $response['display_name'];
            } else {
                return "Lokasi tidak ditemukan";
            }
        } catch (\Exception $e) {
            // Handle errors and log the exception
            \Log::error("Error reverse geocoding: " . $e->getMessage());
            return "Lokasi tidak ditemukan";
        }
    }
}
