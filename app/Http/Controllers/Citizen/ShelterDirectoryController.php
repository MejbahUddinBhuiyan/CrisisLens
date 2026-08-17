<?php

namespace App\Http\Controllers\Citizen;

use App\Http\Controllers\Controller;
use App\Models\Shelter;
use Illuminate\View\View;

class ShelterDirectoryController extends Controller
{
    public function index(): View
    {
        $shelters = Shelter::query()
            ->with(['statuses' => function ($query) {
                $query->latest();
            }])
            ->where('is_active', true)
            ->latest()
            ->paginate(10);

        return view('citizen.shelters.index', compact('shelters'));
    }
}