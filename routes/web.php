<?php

use App\Http\Controllers\BookingController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::view('/', 'booking')->name('booking');        // menampilkan form
Route::view('/booking', 'booking')->name('booking');        // menampilkan form
Route::post('/reservasi', [BookingController::class, 'store'])->name('reservasi.store');

// PAGE FORM REGISTER MEMBER
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

require __DIR__.'/auth.php';
