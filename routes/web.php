<?php

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
Route::get('/auth/redirect', function () {

    return Socialite::driver('github')->with(['prompt' => 'select_account'])->redirect();

})->name('git_redirect');

Route::get('/auth/callback', function () {

    $githubUser = Socialite::driver('github')->user();
    $user = User::updateOrCreate([
        'git_id' => $githubUser->id,
    ], [
        'git_id' => $githubUser->id,
        'git_token' => $githubUser->token,
        'name' => $githubUser->name,
        'email' => $githubUser->email,
        'avatar' => $githubUser->avatar,
    ]);

    Auth::login($user);
    return redirect('/debug');

})->name('git_callback');

Route::get('/debug', function (){
    dd(Auth::user());
})->name("debug");

Route::get('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name("logout");
