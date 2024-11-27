<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\User\Auth\LoginController;
use App\Http\Controllers\User\Auth\RegisterController;
use App\Http\Controllers\User\DeliveryController;
use App\Http\Controllers\User\TopController;
use App\Http\Controllers\User\ArticleController;
use App\Http\Controllers\User\BannerController;
use Illuminate\Auth\Events\Login;

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

Route::get('/', function() {
    return redirect('user/login');
});

Route::prefix('user')->namespace('User')->name('user.')->group(function() {
    Route::get('/login', [App\Http\Controllers\User\Auth\LoginController::class, 'showLoginForm'])->name('show.login');
    Route::post('/login', [App\Http\Controllers\User\Auth\LoginController::class, 'login']);
    Route::post('/logout', [App\Http\Controllers\User\Auth\LoginController::class, 'logout'])->name('logout');
    Route::get('/register', [App\Http\Controllers\User\Auth\RegisterController::class, 'showRegisterForm'])->name('show.register');
    Route::post('/register', [App\Http\Controllers\User\Auth\RegisterController::class, 'userRegister'])->name('register');
    //Route::post('/register', [App\Http\Controllers\User\Auth\RegisterController::class, 'store'])->name('register');
    //Route::post('/register', [App\Http\Controllers\User\Auth\RegisterController::class, 'registerButton'])->name('register');
    Route::get('/top', [App\Http\Controllers\User\TopController::class, 'showTop'])->name('show.top');
    Route::post('/top', [App\Http\Controllers\User\BannerController::class, 'store'])->name('banners.store');
    Route::get('/delivery', [App\Http\Controllers\User\DeliveryController::class, 'showDelivery'])->name('show.delivery');

    Route::get('/profile', [App\Http\Controllers\User\TopController::class, 'showTest'])->name('show.test.profile')->defaults('viewType', 'profile');
    Route::get('/curriculum_progress', [App\Http\Controllers\User\TopController::class, 'showTest'])->name('show.test.curriculum.progress')->defaults('viewType', 'curriculum_progress');
    Route::get('/curriculum_list', [App\Http\Controllers\User\TopController::class, 'showTest'])->name('show.test.curriculum.list')->defaults('viewType', 'curriculum_list');
    Route::get('/article/{article}', [App\Http\Controllers\User\ArticleController::class, 'showArticle'])->name('show.article');
    Route::post('/article', [App\Http\Controllers\User\ArticleController::class, 'store'])->name('articles.store');

});

Auth::routes();
