<?php

namespace App\Http\Controllers\Citizen;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReportRequest;
use App\Models\Report;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ReportController extends Controller
{
    public function index(): View
    {
        $reports = Report::query()
         ->with(['images'])
         ->withCount('images')
         ->where('user_id', Auth::id())
         ->latest()
         ->paginate(10);

        return view('citizen.reports.index', compact('reports'));
    }

    public function create(): View
    {
        return view('citizen.reports.create');
    }

    public function store(StoreReportRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $report = Report::create([
            'user_id' => Auth::id(),
            'category' => $validated['category'],
            'urgency' => $validated['urgency'],
            'description' => $validated['description'],
            'latitude' => $validated['latitude'],
            'longitude' => $validated['longitude'],
            'status' => 'pending',
            'is_verified' => false,
            'is_demo' => true,
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('reports', 'public');

                $report->images()->create([
                    'disk' => 'public',
                    'path' => $path,
                    'original_name' => $image->getClientOriginalName(),
                    'mime_type' => $image->getMimeType(),
                    'size' => $image->getSize(),
                ]);
            }
        }

        return redirect()
            ->route('citizen.reports.index')
            ->with('success', 'Incident report submitted successfully. It is now pending authority review.');
    }
}