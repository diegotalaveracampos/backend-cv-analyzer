<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CVController;

Route::post('/upload-cv', [CVController::class, 'upload']);
Route::get('/cvs', [CVController::class, 'index']);
