<?php

namespace App\Http\Controllers\PublicPortal;

use App\Http\Controllers\Controller;
use App\Models\EmergencyDocument;
use Illuminate\View\View;

class SafetyGuideController extends Controller
{
    public function index(): View
    {
        $documents = EmergencyDocument::query()
            ->where('is_active', true)
            ->where('is_verified', true)
            ->latest()
            ->paginate(9);

        return view('public.safety-guides.index', compact('documents'));
    }

    public function show(EmergencyDocument $emergencyDocument): View
    {
        abort_unless($emergencyDocument->is_active && $emergencyDocument->is_verified, 404);

        return view('public.safety-guides.show', compact('emergencyDocument'));
    }
}