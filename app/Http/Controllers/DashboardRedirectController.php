<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class DashboardRedirectController extends Controller
{
    public function __invoke(): RedirectResponse
    {
        $user = Auth::user();

        if ($user->hasRole('Super Administrator')) {
            return redirect()->route('admin.dashboard');
        }

        if ($user->hasRole('Authority Administrator')) {
            return redirect()->route('authority.dashboard');
        }

        if ($user->hasRole('Emergency Responder')) {
            return redirect()->route('responder.dashboard');
        }

        return redirect()->route('citizen.dashboard');
    }
}