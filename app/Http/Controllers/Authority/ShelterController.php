<?php

namespace App\Http\Controllers\Authority;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreShelterRequest;
use App\Models\Shelter;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ShelterController extends Controller
{
    public function index(): View
    {
        $shelters = Shelter::query()
            ->with(['statuses' => function ($query) {
                $query->latest();
            }])
            ->latest()
            ->paginate(10);

        return view('authority.shelters.index', compact('shelters'));
    }

    public function create(): View
    {
        return view('authority.shelters.create');
    }

    public function store(StoreShelterRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $shelter = Shelter::create([
            'name' => $validated['name'],
            'address' => $validated['address'],
            'latitude' => $validated['latitude'],
            'longitude' => $validated['longitude'],
            'capacity' => $validated['capacity'],
            'current_occupancy' => $validated['current_occupancy'],
            'contact_phone' => $validated['contact_phone'] ?? null,
            'contact_email' => $validated['contact_email'] ?? null,
            'facilities' => $validated['facilities'] ?? [],
            'is_active' => $request->boolean('is_active', true),
            'is_demo' => true,
        ]);

        $shelter->statuses()->create([
            'status' => $validated['status'],
            'available_capacity' => max(0, $shelter->capacity - $shelter->current_occupancy),
            'occupied_capacity' => $shelter->current_occupancy,
            'note' => 'Initial shelter status.',
            'updated_by' => Auth::id(),
        ]);

        activity()
            ->causedBy(Auth::user())
            ->performedOn($shelter)
            ->withProperties([
                'status' => $validated['status'],
                'capacity' => $shelter->capacity,
                'current_occupancy' => $shelter->current_occupancy,
            ])
            ->log('shelter_created');

        return redirect()
            ->route('authority.shelters.index')
            ->with('success', 'Shelter created successfully.');
    }

    public function edit(Shelter $shelter): View
    {
        $shelter->load(['statuses' => function ($query) {
            $query->latest();
        }]);

        return view('authority.shelters.edit', compact('shelter'));
    }

    public function update(StoreShelterRequest $request, Shelter $shelter): RedirectResponse
    {
        $validated = $request->validated();

        $shelter->update([
            'name' => $validated['name'],
            'address' => $validated['address'],
            'latitude' => $validated['latitude'],
            'longitude' => $validated['longitude'],
            'capacity' => $validated['capacity'],
            'current_occupancy' => $validated['current_occupancy'],
            'contact_phone' => $validated['contact_phone'] ?? null,
            'contact_email' => $validated['contact_email'] ?? null,
            'facilities' => $validated['facilities'] ?? [],
            'is_active' => $request->boolean('is_active', true),
        ]);

        $shelter->statuses()->create([
            'status' => $validated['status'],
            'available_capacity' => max(0, $shelter->capacity - $shelter->current_occupancy),
            'occupied_capacity' => $shelter->current_occupancy,
            'note' => 'Shelter status updated.',
            'updated_by' => Auth::id(),
        ]);

        activity()
            ->causedBy(Auth::user())
            ->performedOn($shelter)
            ->withProperties([
                'status' => $validated['status'],
                'capacity' => $shelter->capacity,
                'current_occupancy' => $shelter->current_occupancy,
            ])
            ->log('shelter_updated');

        return redirect()
            ->route('authority.shelters.index')
            ->with('success', 'Shelter updated successfully.');
    }
}