<?php

use Illuminate\Support\Facades\Route;

if (config('blue-flamingos.load_login_route')) {
    Route::get('/login', function () {
        return redirect()->to(config('filament.path') . '/login');
    })->name('login');
}
