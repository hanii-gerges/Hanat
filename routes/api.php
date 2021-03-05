<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CountdownController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//User endpoints
Route::post('/users/register',[AuthController::class,'register']);
Route::post('/users/login',[AuthController::class,'login']);
Route::get('/users/me',[AuthController::class,'userInfo'])->middleware('auth:sanctum');

//Countdown endpoints
Route::post('/countdowns',[CountdownController::class,'store'])->middleware('auth:sanctum');
Route::put('/countdowns/{countdown}',[CountdownController::class,'update'])->middleware('auth:sanctum');
Route::delete('/countdowns/{countdown}',[CountdownController::class,'destroy'])->middleware('auth:sanctum');




