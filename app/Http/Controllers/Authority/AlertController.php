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
        ->with(['publisher', 'approver', 'disaster', 'location'])
        ->when(request('search'), function ($query, $search) {
            $query->where(function ($subQuery) use ($search) {
                $subQuery->where('title', 'like', '%' . $search . '%')
                    ->orWhere('message', 'like', '%' . $search . '%')
                    ->orWhere('risk_level', 'like', '%' . $search . '%')
                    ->orWhere('status', 'like', '%' . $search . '%')
                    ->orWhereHas('publisher', function ($publisherQuery) use ($search) {
                        $publisherQuery->where('name', 'like', '%' . $search . '%')
                            ->orWhere('email', 'like', '%' . $search . '%');
                    });
            });
        })
        ->when(request('risk_level'), function ($query, $riskLevel) {
            $query->where('risk_level', $riskLevel);
        })
        ->when(request('status'), function ($query, $status) {
            $query->where('status', $status);
        })
        ->when(request('approval'), function ($query, $approval) {
            if ($approval === 'approved') {
                $query->where('is_approved', true);
            }

            if ($approval === 'not_approved') {
                $query->where('is_approved', false);
            }

            if ($approval === 'requires_approval') {
                $query->where('requires_human_approval', true);
            }
        })
        ->when(request('date'), function ($query, $date) {
            $query->whereDate('created_at', $date);
        })
        ->latest()
        ->paginate(10)
        ->withQueryString();

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