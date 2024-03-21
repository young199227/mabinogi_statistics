<?php

use App\Http\Controllers\ConnectController;
use App\Http\Controllers\StatisticsController;
use Illuminate\Support\Facades\Route;



// Route::get('/connects', [ConnectController::class, 'create']);

Route::get('/statistics', [StatisticsController::class, 'showIndex']);
