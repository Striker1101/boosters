<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TagsController;
use App\Http\Controllers\LogsController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckRole;
use App\Models\Tag;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    // 1. Get all tags
    $tags = Tag::all();

    // 2. Group them by the part BEFORE the first underscore
    $groupedTags = $tags->groupBy(function ($item, $key) {
        // 'facebook_view' becomes ['facebook', 'view']
        $parts = explode('_', $item->name, 2);
        // Return 'facebook' (this becomes the OptGroup label)
        return $parts[0];
    });

    return view('home', [
        'offers' => config('offers'),
        'groupedTags' => $groupedTags
    ]);
})->name('home');


Route::get('tutorial', function () {
    return view('tutorial');
})->name('tutorial');

Route::post('log', function () {
    return view('log');
})->name('log.create');


Route::middleware('auth', 'verified')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'get_dashboard'])->name('dashboard');
});

    Route::post('/logs', [LogsController::class, 'store'])->name('logs.store');


Route::middleware(['auth', 'verified', CheckRole::class . ':admin'])->group(function () {

    // User routes
    Route::get('/user', [DashboardController::class, 'get_users'])->name('user');
    Route::patch('/user/{id}', [DashboardController::class, 'patch_users'])->name('user.patch');
    Route::delete('/user/{id}', [DashboardController::class, 'delete_users'])->name('user.delete');

     // Fetch referrals and logs for modal
    Route::get('/user/{id}/referrals', [DashboardController::class, 'get_referrals'])->name('user.referrals');
    Route::get('/user/{id}/logs', [DashboardController::class, 'get_logs'])->name('user.logs');

    // Tag routes (resourceful controller)
    // Route::resource('/tag', TagController::class)->names([
    //     'index' => 'tag.index',
    //     'create' => 'tag.create',
    //     'store' => 'tag.store',
    //     'show' => 'tag.show',
    //     'edit' => 'tag.edit',
    //     'update' => 'tag.update',
    //     'destroy' => 'tag.destroy',
    // ]);
    Route::get('/tags', [TagsController::class, 'index'])->name('tags.index');
    Route::post('/tags', [TagsController::class, 'store'])->name('tags.store');
    Route::patch('/tags/{id}', [TagsController::class, 'update'])->name('tags.update');
    Route::delete('/tags/{id}', [TagsController::class, 'destroy'])->name('tags.destroy');



    // Tag routes (resourceful controller)
    // Route::resource('/log', LogController::class)->names([
    //     'index' => 'log.index',
    //     'create' => 'log.create',
    //     'store' => 'log.store',
    //     'show' => 'log.show',
    //     'edit' => 'log.edit',
    //     'update' => 'log.update',
    //     'destroy' => 'log.destroy',
    // ]);
});

require __DIR__.'/auth.php';
