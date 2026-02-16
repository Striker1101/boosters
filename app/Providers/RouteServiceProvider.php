<?php
namespace App\Providers;

use App\Http\Middleware\AdminRole;

Route::middlewareGroup('admin', [
    'auth',
    'verified',
    AdminRole::class,
]);
