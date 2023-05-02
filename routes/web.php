<?php

use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Views\AdminController;
use App\Http\Controllers\Views\ArticlesController;
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
Route::post('user/store', [UserController::class, 'store'])->name('user.store');

// Rotas acessadas apenas por usuário autenticado
Route::middleware('auth')->group(function () {

    Route::controller(HomeController::class)->group(function () {
        Route::get('/home', 'index')->name('home');
    });

    Route::middleware('admin')->prefix('admin')->group(function () {
        Route::controller(AdminController::class)->group(function () {
            Route::get('/', 'articles')->name('admin');
            Route::get('/articles', 'articles')->name('admin.article');
            Route::get('/categories', 'categories')->name('admin.category');
            Route::get('/users', 'users')->name('admin.user');
        });

        Route::controller(UserController::class)->prefix('users')->group(function () {
            Route::get('/get-all', 'index')->name('admin.user.get-all');
            Route::post('/store', 'store')->name('admin.user.store');
            Route::put('/update/{user}', 'update')->name('admin.user.update');
            Route::delete('/destroy/{user}', 'destroy')->name('admin.user.destroy');
        });

        Route::controller(CategoryController::class)->prefix('categories')->group(function () {
            Route::get('/get-all', 'index')->name('admin.category.get-all');
            Route::post('/store', 'store')->name('admin.category.store');
            Route::put('/update/{category}', 'update')->name('admin.category.update');
            Route::delete('/destroy/{category}', 'destroy')->name('admin.category.destroy');
        });

        Route::controller(ArticleController::class)->prefix('articles')->group(function () {
            Route::post('/store', 'store')->name('admin.article.store');
            Route::put('/update/{article}', 'update')->name('admin.article.update');
            Route::delete('/destroy/{article}', 'destroy')->name('admin.article.destroy');
        });
    });

    Route::controller(ArticlesController::class)->group(function () {
        Route::get('/categories/{category}/articles', 'getByCategories')->name('admin.article.get-by-categories');
        Route::get('/articles/{article}', 'getByArticle')->name('admin.article.get-by-article');
    });
});
