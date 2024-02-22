<?php

use App\Application\Http\Controllers\ProController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json([
        'data' => ['Welcome to Cloud Humans Backend Testing']
    ]);
})->name('welcome-api');

Route::post('/pro/select-project', [ProController::class, 'selectProject'])->name('select-project');
