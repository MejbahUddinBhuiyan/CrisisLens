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
        ->when(request('search'), function ($query, $search) {
            $query->where(function ($subQuery) use ($search) {
                $subQuery->where('name', 'like', '%' . $search . '%')
                    ->orWhere('address', 'like', '%' . $search . '%')
                    ->orWhere('contact', 'like', '%' . $search . '%')
                    ->orWhere('facilities', 'like', '%' . $search . '%');
            });
        })
        ->when(request('status'), function ($query, $status) {
            if ($status === 'active') {
                $query->where('is_active', true);
            }

            if ($status === 'inactive') {
                $query->where('is_active', false);
            }

            if ($status === 'available') {
                $query->whereColumn('current_occupancy', '<', 'capacity')
                    ->where('is_active', true);
            }

            if ($status === 'full') {
                $query->whereColumn('current_occupancy', '>=', 'capacity');
            }
        })
        ->when(request('facility'), function ($query, $facility) {
            $query->whereJsonContains('facilities', $facility);
        })
        ->when(request('min_capacity'), function ($query, $capacity) {
            $query->where('capacity', '>=', (int) $capacity);
        })
        ->latest()
        ->paginate(10)
        ->withQueryString();

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