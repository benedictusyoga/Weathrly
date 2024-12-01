<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reports = Report::all(); // Ambil semua laporan dari database
        return view('reports.index', compact('reports'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('report');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $path = null;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
        }

        // Menyimpan laporan ke database
        $report = new Report();
        $report->title = $request->input('title');
        $report->description = $request->input('description');
        $report->location = $request->input('location');
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
        return view('reports.show', compact('report'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Report $report)
    {
        return view('reports.edit', compact('report'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Report $report)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Update image jika ada
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
            $report->image_path = $path;
        }

        // Update data lainnya
        $report->title = $validated['title'];
        $report->description = $validated['description'];
        $report->location = $validated['location'];
        $report->save();
        $report->update($validated);

        return redirect()->route('reports.index')->with('success', 'Laporan berhasil diperbarui!');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Report $report)
    {
        $report->delete();
        return redirect()->route('reports.index')->with('success', 'Laporan berhasil dihapus!');
    }
}
