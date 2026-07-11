<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\AiTestController;
use App\Http\Controllers\Authority\DashboardController as AuthorityDashboardController;
use App\Http\Controllers\Citizen\DashboardController as CitizenDashboardController;
use App\Http\Controllers\DashboardRedirectController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Responder\DashboardController as ResponderDashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/ai-test/flood-risk', [AiTestController::class, 'floodRisk'])
    ->name('ai-test.flood-risk');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', DashboardRedirectController::class)
        ->name('dashboard');

    Route::get('/citizen/dashboard', CitizenDashboardController::class)
        ->middleware('role:Citizen|Super Administrator')
        ->name('citizen.dashboard');

    Route::get('/responder/dashboard', ResponderDashboardController::class)
        ->middleware('role:Emergency Responder|Super Administrator')
        ->name('responder.dashboard');

    Route::get('/authority/dashboard', AuthorityDashboardController::class)
        ->middleware('role:Authority Administrator|Super Administrator')
        ->name('authority.dashboard');

    Route::get('/admin/dashboard', AdminDashboardController::class)
        ->middleware('role:Super Administrator')
        ->name('admin.dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

require __DIR__.'/auth.php';