<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('getAll',[\App\Http\Controllers\Api\ApiController::class,'getAll']);
Route::get('getById/{id}',[\App\Http\Controllers\Api\ApiController::class,'getById']);
Route::post('create',[\App\Http\Controllers\Api\ApiController::class,'create']);
Route::put('update/{id}',[\App\Http\Controllers\Api\ApiController::class,'update']);
Route::post('createtwo/{name}/{email}/{password}/{password_confirmation}',[\App\Http\Controllers\Api\ApiController::class,'createtwo']);
Route::put('updatetwo/{id}/{name}/{email}/{password}/{password_confirmation}',[\App\Http\Controllers\Api\ApiController::class,'updatetwo']);
