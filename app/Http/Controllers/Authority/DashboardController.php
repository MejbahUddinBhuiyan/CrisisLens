<?php

namespace App\Http\Controllers\Authority;

use App\Http\Controllers\Controller;
use App\Models\Alert;
use App\Models\Report;
use App\Models\Shelter;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        $stats = [
            'total_reports' => Report::count(),
            'pending_reports' => Report::where('status', 'pending')->count(),
            'verified_reports' => Report::where('status', 'verified')->count(),
            'active_shelters' => Shelter::where('is_active', true)->count(),
            'published_alerts' => Alert::where('status', 'published')->where('is_approved', true)->count(),
        ];

        return view('authority.dashboard', compact('stats'));
    }
}