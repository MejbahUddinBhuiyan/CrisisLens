<?php

namespace App\Http\Controllers\Citizen;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        $userId = Auth::id();

        $stats = [
            'my_reports' => Report::where('user_id', $userId)->count(),
            'pending_reports' => Report::where('user_id', $userId)->where('status', 'pending')->count(),
            'verified_reports' => Report::where('user_id', $userId)->where('status', 'verified')->count(),
            'resolved_reports' => Report::where('user_id', $userId)->where('status', 'resolved')->count(),
        ];

        return view('citizen.dashboard', compact('stats'));
    }
}