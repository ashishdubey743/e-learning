<?php

use App\Livewire\Home\Home;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/', Home::class)->name('home');
});
require __DIR__ . '/modules/auth.php';
require __DIR__ . '/modules/user.php';
