<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\UserController;

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

Route::get('/user', [UserController::class, 'index']);
Route::post('/user/store', [UserController::class, 'userPostRegistration']);
Route::get('/user/login', [UserController::class, 'userLoginIndex']);
Route::post('/login', [UserController::class, 'userPostLogin']);
Route::get('/dashboard', [UserController::class, 'dashboard']);
Route::get('logout', [UserController::class, 'logout']);
