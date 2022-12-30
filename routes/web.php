<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('login');
})->name('home');
Route::post('register',[\App\Http\Controllers\Yajra::class,'register'])->name('register-post');
Route::get('/yajra',function (){
    return view('yajra');
})->name('yajra');
Route::get('yajra/users',[\App\Http\Controllers\Yajra::class,'usersFetch'])->name('usersFetch');
