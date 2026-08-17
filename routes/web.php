<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\AiTestController;
use App\Http\Controllers\Authority\AlertController as AuthorityAlertController;
use App\Http\Controllers\Authority\DashboardController as AuthorityDashboardController;
use App\Http\Controllers\Authority\ReportReviewController;
use App\Http\Controllers\Authority\ShelterController as AuthorityShelterController;
use App\Http\Controllers\Citizen\AlertController as CitizenAlertController;
use App\Http\Controllers\Citizen\DashboardController as CitizenDashboardController;
use App\Http\Controllers\Citizen\ReportController as CitizenReportController;
use App\Http\Controllers\Citizen\ShelterDirectoryController;
use App\Http\Controllers\DashboardRedirectController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Responder\DashboardController as ResponderDashboardController;
use App\Http\Controllers\Responder\ReportResponseController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserManagementController;

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

    Route::prefix('admin')
        ->name('admin.')
        ->middleware('role:Super Administrator')
        ->group(function () {
            Route::get('/users', [UserManagementController::class, 'index'])->name('users.index');
            Route::get('/users/create', [UserManagementController::class, 'create'])->name('users.create');
            Route::post('/users', [UserManagementController::class, 'store'])->name('users.store');
            Route::get('/users/{user}/edit', [UserManagementController::class, 'edit'])->name('users.edit');
            Route::patch('/users/{user}', [UserManagementController::class, 'update'])->name('users.update');
    });    

    Route::prefix('authority')
        ->name('authority.')
        ->middleware('role:Authority Administrator|Super Administrator')
        ->group(function () {
            Route::get('/reports', [ReportReviewController::class, 'index'])->name('reports.index');
            Route::get('/reports/{report}', [ReportReviewController::class, 'show'])->name('reports.show');
            Route::patch('/reports/{report}/approve', [ReportReviewController::class, 'approve'])->name('reports.approve');
            Route::patch('/reports/{report}/reject', [ReportReviewController::class, 'reject'])->name('reports.reject');

            Route::get('/shelters', [AuthorityShelterController::class, 'index'])->name('shelters.index');
            Route::get('/shelters/create', [AuthorityShelterController::class, 'create'])->name('shelters.create');
            Route::post('/shelters', [AuthorityShelterController::class, 'store'])->name('shelters.store');
            Route::get('/shelters/{shelter}/edit', [AuthorityShelterController::class, 'edit'])->name('shelters.edit');
            Route::patch('/shelters/{shelter}', [AuthorityShelterController::class, 'update'])->name('shelters.update');

            Route::get('/alerts', [AuthorityAlertController::class, 'index'])->name('alerts.index');
            Route::get('/alerts/create', [AuthorityAlertController::class, 'create'])->name('alerts.create');
            Route::post('/alerts', [AuthorityAlertController::class, 'store'])->name('alerts.store');
            Route::get('/alerts/{alert}/edit', [AuthorityAlertController::class, 'edit'])->name('alerts.edit');
            Route::patch('/alerts/{alert}', [AuthorityAlertController::class, 'update'])->name('alerts.update');
        });

    Route::prefix('responder')
        ->name('responder.')
        ->middleware('role:Emergency Responder|Super Administrator')
        ->group(function () {
            Route::get('/reports', [ReportResponseController::class, 'index'])->name('reports.index');
            Route::get('/reports/{report}', [ReportResponseController::class, 'show'])->name('reports.show');
            Route::patch('/reports/{report}/under-review', [ReportResponseController::class, 'markUnderReview'])->name('reports.under-review');
            Route::patch('/reports/{report}/resolved', [ReportResponseController::class, 'markResolved'])->name('reports.resolved');
        });

    Route::prefix('citizen')
        ->name('citizen.')
        ->middleware('role:Citizen|Super Administrator')
        ->group(function () {
            Route::get('/reports', [CitizenReportController::class, 'index'])->name('reports.index');
            Route::get('/reports/create', [CitizenReportController::class, 'create'])->name('reports.create');
            Route::post('/reports', [CitizenReportController::class, 'store'])->name('reports.store');
        });

    Route::prefix('citizen')
        ->name('citizen.')
        ->middleware('role:Citizen|Emergency Responder|Super Administrator')
        ->group(function () {
            Route::get('/shelters', [ShelterDirectoryController::class, 'index'])->name('shelters.index');
            Route::get('/alerts', [CitizenAlertController::class, 'index'])->name('alerts.index');
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