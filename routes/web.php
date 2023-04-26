<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Views\AdminController;
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
    Route::get('/logout', 'logout')->name('logout');
});
Route::post('user/store', [\App\Http\Controllers\Api\UserController::class, 'store'])->name('web.user.store');

// Rotas acessadas apenas por usuário autenticado
Route::middleware('auth')->group(function () {

    Route::controller(HomeController::class)->group(function () {
        Route::get('/home', 'index')->name('home');
    });

    Route::middleware('admin')->prefix('admin')->group(function () {
        Route::controller(AdminController::class)->group(function () {
            Route::get('/', 'articles')->name('admin');
            Route::get('/articles', 'articles')->name('admin.articles');
            Route::get('/categories', 'categories')->name('admin.categories');
            Route::get('/users', 'users')->name('admin.user');
        });
    });
});
