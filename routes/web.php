<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\WorkController;
use App\Http\Controllers\Admin\MovementController;
use App\Http\Controllers\Admin\ArtistController;

Route::get('/', function () {
    return view('welcome');
})->name('home')->middleware(['auth', 'verified']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('/works', WorkController::class)->middleware(['auth', 'verified']);
Route::resource('/movements', MovementController::class)->middleware(['auth', 'verified']);
Route::resource('/artists', ArtistController::class)->middleware(['auth', 'verified']);

require __DIR__.'/auth.php';
