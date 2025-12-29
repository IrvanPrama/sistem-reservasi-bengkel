<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\PelangganController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

// 1
Route::view('/', 'landing-page.index')->name('landing-page');
Route::view('/booking', 'booking')->name('booking');        // menampilkan form
Route::post('/reservasi', [BookingController::class, 'store'])->name('reservasi.store');

// 3
Route::get('/daftar-member', [PelangganController::class, 'index'])->name('member.form');
Route::post('/daftar-member', [PelangganController::class, 'store'])->name('member.store');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

Route::get('/booking/{id}', [BookingController::class, 'show'])->name('booking.show');

require __DIR__.'/auth.php';
