<?php

namespace App\Http\Controllers\Authority;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ReportReviewController extends Controller
{
    public function index(): View
    {
        $reports = Report::query()
            ->with([
                'user',
                'images',
                'predictions' => function ($query) {
                    $query->latest();
                },
            ])
            ->withCount('images')
            ->latest()
            ->paginate(10);

        return view('authority.reports.index', compact('reports'));
    }

    public function show(Report $report): View
    {
        $report->load([
            'user',
            'images',
            'predictions' => function ($query) {
                $query->latest();
            },
            'validator',
        ]);

        return view('authority.reports.show', compact('report'));
    }

    public function approve(Request $request, Report $report): RedirectResponse
    {
        $validated = $request->validate([
            'validation_note' => ['nullable', 'string', 'max:2000'],
        ]);

        $report->update([
            'status' => 'verified',
            'is_verified' => true,
            'validated_by' => Auth::id(),
            'validated_at' => now(),
            'validation_note' => $validated['validation_note'] ?? null,
        ]);

        activity()
            ->causedBy(Auth::user())
            ->performedOn($report)
            ->withProperties([
                'status' => 'verified',
                'validation_note' => $validated['validation_note'] ?? null,
            ])
            ->log('report_verified');

        return redirect()
            ->route('authority.reports.show', $report)
            ->with('success', 'Report approved and marked as verified.');
    }

    public function reject(Request $request, Report $report): RedirectResponse
    {
        $validated = $request->validate([
            'validation_note' => ['required', 'string', 'min:5', 'max:2000'],
        ]);

        $report->update([
            'status' => 'rejected',
            'is_verified' => false,
            'validated_by' => Auth::id(),
            'validated_at' => now(),
            'validation_note' => $validated['validation_note'],
        ]);

        activity()
            ->causedBy(Auth::user())
            ->performedOn($report)
            ->withProperties([
                'status' => 'rejected',
                'validation_note' => $validated['validation_note'],
            ])
            ->log('report_rejected');

        return redirect()
            ->route('authority.reports.show', $report)
            ->with('success', 'Report rejected with validation note.');
    }
}