<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CommController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsulanController;

Route::redirect('/', '/login');
Route::get('/login', fn () => view('auth.login'))->name('login');
Route::post('/login', fn () => redirect()->route('dashboard'))->name('login.store');

Route::get('/forgot-password', [ForgotPasswordController::class, 'create'])->name('password.request');
Route::post('forgot-password', fn () => redirect()->route('login'))->name('password.email');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/usulan', [UsulanController::class, 'create'])->name('usulan.create');
Route::get('/usulan/show', [UsulanController::class, 'showLegacy'])->name('usulan.show.legacy');
Route::get('/usulan/{id}', [UsulanController::class, 'show'])->whereNumber('id')->name('usulan.show');
Route::get('/usulan/{id}/comm', [CommController::class, 'show'])
    ->whereNumber('id')->name('usulan.comm');
Route::put('/usulan/{id}', [UsulanController::class, 'update'])->whereNumber('id')->name('usulan.update');
Route::get('/usulan/{id}/dokumen/{dokumen}/lihat', [UsulanController::class, 'lihatDokumen'])
    ->whereNumber(['id', 'dokumen'])->name('usulan.dokumen.lihat');
Route::get('/usulan/{id}/dokumen/{dokumen}/unduh', [UsulanController::class, 'unduhDokumen'])
    ->whereNumber(['id', 'dokumen'])->name('usulan.dokumen.unduh');

Route::get('/profil', [ProfileController::class, 'edit'])->name('profile.edit');
Route::post('/logout', fn () => redirect()->route('login'))->name('logout');