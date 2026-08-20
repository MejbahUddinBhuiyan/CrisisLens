<?php

namespace App\Http\Controllers\Responder;

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
            'verified_reports' => Report::where('status', 'verified')->count(),
            'under_review_reports' => Report::where('status', 'under_review')->count(),
            'resolved_reports' => Report::where('status', 'resolved')->count(),
            'active_shelters' => Shelter::where('is_active', true)->count(),
            'active_alerts' => Alert::where('status', 'published')->where('is_approved', true)->count(),
        ];

        return view('responder.dashboard', compact('stats'));
    }
}