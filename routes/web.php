<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource('books', BookController::class);

Route::get('AllBooks', [BookController::class,'AllBooks']);

Route::get('/reserver/{id}', [BookController::class,'reserver']);

Route::get('/signup',[AuthController::class,'signup']);

Route::get('/signin',[AuthController::class,'signin']);