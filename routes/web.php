<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DomainController;
use App\Http\Controllers\WhoisController;

Route::view('/', 'home');

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::view('profile', 'profile')->name('profile');

    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::get('domains', [DomainController::class, 'index'])->name('domains.index');
    Route::get('whois', [WhoisController::class, 'index'])->name('whois.index');
    Route::get('whois/search', [WhoisController::class, 'search'])->name('whois.search');

    Route::post('users', [UserController::class, 'store'])->name('users.store');
    Route::post('domains', [DomainController::class, 'store'])->name('domains.store');
    Route::post('whois', [WhoisController::class, 'store'])->name('whois.store');

    Route::put('users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::put('domains/{domain}', [DomainController::class, 'update'])->name('domains.update');

    Route::delete('users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::delete('domains/{domain}', [DomainController::class, 'destroy'])->name('domains.destroy');

});
    
require __DIR__.'/auth.php';
