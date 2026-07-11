<?php

namespace App\Http\Controllers\Responder;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        return view('responder.dashboard');
    }
}