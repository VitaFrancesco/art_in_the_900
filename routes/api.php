<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\WorkController;
use App\Http\Controllers\Api\ArtistController;
use App\Http\Controllers\Api\MovementController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::get('/works', [WorkController::class, 'index']);

Route::get('/works/{work}', [WorkController::class, 'show']);

Route::get('/artists', [ArtistController::class, 'index']);

Route::get('/artists/{artist}', [ArtistController::class, 'show']);

Route::get('/movements', [MovementController::class, 'index']);

Route::get('/movements/{movement}', [MovementController::class, 'show']);