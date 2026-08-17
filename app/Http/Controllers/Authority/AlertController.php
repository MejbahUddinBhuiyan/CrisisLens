<?php

namespace App\Http\Controllers\Authority;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAlertRequest;
use App\Models\Alert;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AlertController extends Controller
{
    public function index(): View
    {
        $alerts = Alert::query()
            ->with(['publisher', 'approver'])
            ->latest()
            ->paginate(10);

        return view('authority.alerts.index', compact('alerts'));
    }

    public function create(): View
    {
        return view('authority.alerts.create');
    }

    public function store(StoreAlertRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $status = $validated['status'];
        $isApproved = $request->boolean('is_approved');
        $requiresHumanApproval = $request->boolean('requires_human_approval', true);

        if ($validated['risk_level'] === 'Critical') {
            $requiresHumanApproval = true;
            $isApproved = true;
        }

        $alert = Alert::create([
            'title' => $validated['title'],
            'message' => $validated['message'],
            'risk_level' => $validated['risk_level'],
            'status' => $status,
            'requires_human_approval' => $requiresHumanApproval,
            'is_approved' => $isApproved,
            'published_by' => Auth::id(),
            'approved_by' => $isApproved ? Auth::id() : null,
            'approved_at' => $isApproved ? now() : null,
            'published_at' => $status === 'published' ? now() : null,
            'expires_at' => $validated['expires_at'] ?? null,
            'is_demo' => true,
        ]);

        activity()
            ->causedBy(Auth::user())
            ->performedOn($alert)
            ->withProperties([
                'risk_level' => $alert->risk_level,
                'status' => $alert->status,
                'is_approved' => $alert->is_approved,
            ])
            ->log('alert_created');

        return redirect()
            ->route('authority.alerts.index')
            ->with('success', 'Alert created successfully.');
    }

    public function edit(Alert $alert): View
    {
        return view('authority.alerts.edit', compact('alert'));
    }

    public function update(StoreAlertRequest $request, Alert $alert): RedirectResponse
    {
        $validated = $request->validated();

        $status = $validated['status'];
        $isApproved = $request->boolean('is_approved');
        $requiresHumanApproval = $request->boolean('requires_human_approval', true);

        if ($validated['risk_level'] === 'Critical') {
            $requiresHumanApproval = true;
            $isApproved = true;
        }

        $alert->update([
            'title' => $validated['title'],
            'message' => $validated['message'],
            'risk_level' => $validated['risk_level'],
            'status' => $status,
            'requires_human_approval' => $requiresHumanApproval,
            'is_approved' => $isApproved,
            'approved_by' => $isApproved ? Auth::id() : null,
            'approved_at' => $isApproved ? now() : null,
            'published_at' => $status === 'published'
                ? ($alert->published_at ?? now())
                : null,
            'expires_at' => $validated['expires_at'] ?? null,
        ]);

        activity()
            ->causedBy(Auth::user())
            ->performedOn($alert)
            ->withProperties([
                'risk_level' => $alert->risk_level,
                'status' => $alert->status,
                'is_approved' => $alert->is_approved,
            ])
            ->log('alert_updated');

        return redirect()
            ->route('authority.alerts.index')
            ->with('success', 'Alert updated successfully.');
    }
}