<?php

namespace App\Http\Controllers\Citizen;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReportRequest;
use App\Jobs\ProcessReportFloodRiskPrediction;
use App\Models\Report;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ReportController extends Controller
{
public function index(): View
{
    $reports = Report::query()
        ->with([
            'images',
            'predictions' => function ($query) {
                $query->latest();
            },
        ])
        ->withCount('images')
        ->where('user_id', Auth::id())
        ->when(request('search'), function ($query, $search) {
            $query->where(function ($subQuery) use ($search) {
                $subQuery->where('description', 'like', '%' . $search . '%')
                    ->orWhere('category', 'like', '%' . $search . '%')
                    ->orWhere('urgency', 'like', '%' . $search . '%')
                    ->orWhere('status', 'like', '%' . $search . '%');
            });
        })
        ->when(request('category'), function ($query, $category) {
            $query->where('category', $category);
        })
        ->when(request('urgency'), function ($query, $urgency) {
            $query->where('urgency', $urgency);
        })
        ->when(request('status'), function ($query, $status) {
            $query->where('status', $status);
        })
        ->when(request('ai_prediction'), function ($query, $prediction) {
            $query->whereHas('predictions', function ($predictionQuery) use ($prediction) {
                $predictionQuery->where('prediction', $prediction);
            });
        })
        ->when(request('date'), function ($query, $date) {
            $query->whereDate('created_at', $date);
        })
        ->latest()
        ->paginate(10)
        ->withQueryString();

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

        ProcessReportFloodRiskPrediction::dispatch($report);

        return redirect()
            ->route('citizen.reports.index')
            ->with('success', 'Incident report submitted successfully. It is now pending authority review.');
    }

    public function show(Report $report): View
    {
        abort_unless($report->user_id === Auth::id(), 403);

        $report->load([
            'images',
            'predictions' => function ($query) {
                $query->latest();
            },
        ]);

        return view('citizen.reports.show', compact('report'));
    }
}