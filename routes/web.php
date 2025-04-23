<?php

use App\Http\Middleware\UserAuthMiddleware;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

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

Route::get('/', "App\Http\Controllers\HomeController@index")->name("home");
Route::get('/nina', 'App\Http\Controllers\LoginController@nina')->name('nina');
Route::get('/auth/redirect', 'App\Http\Controllers\LoginController@gitredirect')->name('git_redirect');
Route::get('/auth/callback', 'App\Http\Controllers\LoginController@gitcallback')->name('git_callback');;
Route::middleware(UserAuthMiddleware::class)->group(function () {
    Route::get('/logout', 'App\Http\Controllers\LoginController@logout')->name("logout");
    Route::get('/profile', 'App\Http\Controllers\UserPagesController@profile')->name('profile');
    Route::post('/post', 'App\Http\Controllers\UserActionsController@post')->name('post');
    Route::post('/edit', 'App\Http\Controllers\UserActionsController@edit')->name('edit');
});
