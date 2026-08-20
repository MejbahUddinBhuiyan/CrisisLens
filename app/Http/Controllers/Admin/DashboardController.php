<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alert;
use App\Models\Report;
use App\Models\Shelter;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        $stats = [
            'total_users' => User::count(),
            'total_reports' => Report::count(),
            'pending_reports' => Report::where('status', 'pending')->count(),
            'resolved_reports' => Report::where('status', 'resolved')->count(),
            'active_shelters' => Shelter::where('is_active', true)->count(),
            'published_alerts' => Alert::where('status', 'published')->where('is_approved', true)->count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}