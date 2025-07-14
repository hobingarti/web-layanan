<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LayananController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/layanans/by-jenis/{id}', [LayananController::class, 'byJenis'])->name('layanans.by-jenis')->middleware(['auth', 'verified']);
Route::get('/layanans', fn () => view('layanans.index'))->name('layanans.index')->middleware(['auth', 'verified']);
Route::get('/jenis-layanans', fn () => view('jenis-layanans.index'))->name('jenis-layanans.index')->middleware(['auth', 'verified']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
