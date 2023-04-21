<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Views\HomeController;
use Illuminate\Support\Facades\Route;

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

Route::controller(AuthController::class)->group(function () {
    Route::get('/', 'index')->name('login');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
});
Route::post('user/store', [\App\Http\Controllers\Api\UserController::class, 'store'])->name('web.user.store');

// Rotas acessadas apenas por usuário autenticado
Route::middleware('auth')->group(function () {

    Route::controller(HomeController::class)->group(function () {
        Route::get('/home', 'index')->name('home');
    });
});
