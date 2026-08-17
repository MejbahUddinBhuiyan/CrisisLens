<?php

namespace App\Http\Controllers\Responder;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ReportResponseController extends Controller
{
    public function index(): View
    {
        $reports = Report::query()
            ->with([
                'user',
                'images',
                'validator',
                'predictions' => function ($query) {
                    $query->latest();
                },
            ])
            ->withCount('images')
            ->whereIn('status', ['verified', 'under_review', 'resolved'])
            ->latest()
            ->paginate(10);

        return view('responder.reports.index', compact('reports'));
    }

    public function show(Report $report): View
    {
        abort_unless(in_array($report->status, ['verified', 'under_review', 'resolved']), 403);

        $report->load([
            'user',
            'images',
            'validator',
            'predictions' => function ($query) {
                $query->latest();
            },
        ]);

        return view('responder.reports.show', compact('report'));
    }

    public function markUnderReview(Request $request, Report $report): RedirectResponse
    {
        abort_unless(in_array($report->status, ['verified', 'under_review']), 403);

        $validated = $request->validate([
            'response_note' => ['nullable', 'string', 'max:2000'],
        ]);

        $report->update([
            'status' => 'under_review',
            'validation_note' => $validated['response_note'] ?? $report->validation_note,
        ]);

        activity()
            ->causedBy(Auth::user())
            ->performedOn($report)
            ->withProperties([
                'status' => 'under_review',
                'response_note' => $validated['response_note'] ?? null,
            ])
            ->log('responder_started_review');

        return redirect()
            ->route('responder.reports.show', $report)
            ->with('success', 'Report marked as under review.');
    }

    public function markResolved(Request $request, Report $report): RedirectResponse
    {
        abort_unless(in_array($report->status, ['verified', 'under_review']), 403);

        $validated = $request->validate([
            'response_note' => ['required', 'string', 'min:5', 'max:2000'],
        ]);

        $report->update([
            'status' => 'resolved',
            'validation_note' => $validated['response_note'],
        ]);

        activity()
            ->causedBy(Auth::user())
            ->performedOn($report)
            ->withProperties([
                'status' => 'resolved',
                'response_note' => $validated['response_note'],
            ])
            ->log('responder_resolved_report');

        return redirect()
            ->route('responder.reports.show', $report)
            ->with('success', 'Report marked as resolved.');
    }
}