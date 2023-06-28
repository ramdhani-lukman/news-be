<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\NewsController;
use App\Http\Controllers\API\User\PreferenceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);

Route::prefix('/news')->group(function(){
    Route::get('/headlines',[NewsController::class,'headlines']);
    Route::get('/search',[NewsController::class,'search']);
    Route::get('/source',[NewsController::class,'source']);
});

Route::post('/user/preference',[PreferenceController::class,'save'])->middleware('auth:sanctum');


