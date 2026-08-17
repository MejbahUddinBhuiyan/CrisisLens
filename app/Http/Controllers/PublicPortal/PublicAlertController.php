<?php

namespace App\Http\Controllers\PublicPortal;

use App\Http\Controllers\Controller;
use App\Models\Alert;
use Illuminate\View\View;

class PublicAlertController extends Controller
{
    public function index(): View
    {
        $alerts = Alert::query()
            ->with(['publisher'])
            ->where('status', 'published')
            ->where('is_approved', true)
            ->where(function ($query) {
                $query->whereNull('expires_at')
                    ->orWhere('expires_at', '>', now());
            })
            ->latest('published_at')
            ->paginate(10);

        return view('public.alerts.index', compact('alerts'));
    }
}