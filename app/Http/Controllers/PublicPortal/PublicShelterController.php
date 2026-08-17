<?php

namespace App\Http\Controllers\PublicPortal;

use App\Http\Controllers\Controller;
use App\Models\Shelter;
use Illuminate\View\View;

class PublicShelterController extends Controller
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

        return view('public.shelters.index', compact('shelters'));
    }
}