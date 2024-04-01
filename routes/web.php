<?php
use App\Http\Controllers\ConnectController;
use App\Http\Controllers\StatisticsController;
use Illuminate\Support\Facades\Route;

#測試路線
Route::get('/test', [StatisticsController::class, 'test']);

#首頁
Route::get('/indexData', [StatisticsController::class, 'getIndexData']);
