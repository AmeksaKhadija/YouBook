<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReservationController;


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

Route::get('/signup', [AuthController::class, 'showsignup'])->name('signup');

Route::post('/signup', [AuthController::class, 'signup'])->name('signup.post');

Route::get('/signin', [AuthController::class, 'showsignin'])->name('signin');

Route::post('/signinpost', [AuthController::class, 'signin']);

Route::resource('reservation', ReservationController::class);

Route::resource('role', RoleController::class);

Route::resource('user', UserController::class);

Route::get('/retirer/{id}', [BookController::class,'retirer']);