<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\CampaignTargetController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SimulationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public simulation routes
|--------------------------------------------------------------------------
|
| These stay reachable without a session, because participants are ordinary
| people who followed a link. Access is gated per campaign by the enrolled
| participant's token rather than by login, and throttled so the endpoints
| cannot be used to sweep for valid tokens.
|
*/
Route::middleware('throttle:60,1')->prefix('s')->name('simulation.')->group(function () {
    Route::get('{campaign}', [SimulationController::class, 'lure'])->name('lure');
    Route::get('{campaign}/login', [SimulationController::class, 'login'])->name('login');
    Route::post('{campaign}/login', [SimulationController::class, 'submit'])->name('submit');
    Route::get('{campaign}/debrief', [SimulationController::class, 'debrief'])->name('debrief');
    Route::post('{campaign}/report', [SimulationController::class, 'report'])->name('report');
});

/*
|--------------------------------------------------------------------------
| Public landing page
|--------------------------------------------------------------------------
|
| Reachable without a session. It advertises the service and links staff to
| the login; it exposes no campaign data and no operator functionality.
|
*/
Route::view('/', 'landing')->name('home');

/*
|--------------------------------------------------------------------------
| Everything else requires a signed-in account
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('/tutorial', 'tutorial')->name('tutorial');

    // Admins and super admins.
    Route::middleware('role:admin,super_admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('/campaigns', [CampaignController::class, 'index'])->name('campaigns.index');
        Route::get('/campaigns/create', [CampaignController::class, 'create'])->name('campaigns.create');
        Route::post('/campaigns', [CampaignController::class, 'store'])->name('campaigns.store');
        Route::get('/campaigns/{campaign}', [CampaignController::class, 'show'])->name('campaigns.show');
        Route::get('/campaigns/{campaign}/edit', [CampaignController::class, 'edit'])->name('campaigns.edit');
        Route::put('/campaigns/{campaign}', [CampaignController::class, 'update'])->name('campaigns.update');
        Route::patch('/campaigns/{campaign}/status', [CampaignController::class, 'updateStatus'])->name('campaigns.status');
        Route::delete('/campaigns/{campaign}', [CampaignController::class, 'destroy'])->name('campaigns.destroy');

        Route::post('/campaigns/{campaign}/targets', [CampaignTargetController::class, 'store'])->name('campaigns.targets.store');
        Route::post('/campaigns/{campaign}/targets/import', [CampaignTargetController::class, 'import'])->name('campaigns.targets.import');
        Route::delete('/campaigns/{campaign}/targets/{target}', [CampaignTargetController::class, 'destroy'])->name('campaigns.targets.destroy');
    });

    // Super admin only: staff and tag management.
    Route::middleware('role:super_admin')->prefix('admins')->name('admins.')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('index');
        Route::post('/', [AdminController::class, 'store'])->name('store');
        Route::patch('/{admin}', [AdminController::class, 'update'])->name('update');
        Route::post('/{admin}/tag', [AdminController::class, 'rotateTag'])->name('tag');
        Route::post('/{admin}/toggle', [AdminController::class, 'toggle'])->name('toggle');
        Route::delete('/{admin}', [AdminController::class, 'destroy'])->name('destroy');
    });
});

require __DIR__ . '/auth.php';
