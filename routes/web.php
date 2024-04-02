<?php

use App\Http\Controllers\ConnectController;
use App\Http\Controllers\StatisticsController;
use Illuminate\Support\Facades\Route;

#測試路線
Route::get('/test', [StatisticsController::class, 'test']);

#首頁
Route::get('/indexData', [StatisticsController::class, 'getIndexData']);
#發送csrf_token
Route::get('/token', [StatisticsController::class, 'getToken']);
#使用者上傳
Route::post('/create', [StatisticsController::class, 'create']);


#檢查IP群組
Route::middleware('check.ip')->group(function () {
    #拿沒驗證的使用者
    Route::get('/unverified', [StatisticsController::class, 'getUnverifiedUploads']);
    #驗證上傳資料
    Route::post('/verify/{verifyNumber}', [StatisticsController::class, 'verifyUserUploads']);
});
