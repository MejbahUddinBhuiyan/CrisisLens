<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\AiTestController;
use App\Http\Controllers\Authority\DashboardController as AuthorityDashboardController;
use App\Http\Controllers\Citizen\DashboardController as CitizenDashboardController;
use App\Http\Controllers\DashboardRedirectController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Responder\DashboardController as ResponderDashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Citizen\ReportController as CitizenReportController;
use App\Http\Controllers\Authority\ReportReviewController;

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

    Route::prefix('authority')
        ->name('authority.')
        ->middleware('role:Authority Administrator|Super Administrator')
        ->group(function () {
            Route::get('/reports', [ReportReviewController::class, 'index'])->name('reports.index');
            Route::get('/reports/{report}', [ReportReviewController::class, 'show'])->name('reports.show');
            Route::patch('/reports/{report}/approve', [ReportReviewController::class, 'approve'])->name('reports.approve');
            Route::patch('/reports/{report}/reject', [ReportReviewController::class, 'reject'])->name('reports.reject');
    });

    Route::get('/admin/dashboard', AdminDashboardController::class)
        ->middleware('role:Super Administrator')
        ->name('admin.dashboard');
        Route::prefix('citizen')
    ->name('citizen.')
    ->middleware('role:Citizen|Super Administrator')
    ->group(function () {
        Route::get('/reports', [CitizenReportController::class, 'index'])->name('reports.index');
        Route::get('/reports/create', [CitizenReportController::class, 'create'])->name('reports.create');
        Route::post('/reports', [CitizenReportController::class, 'store'])->name('reports.store');
    });
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