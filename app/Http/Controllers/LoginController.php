<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Laravel\Socialite\Facades\Socialite;

class LoginController
{
    public function nina(){
        Auth::loginUsingId(2);
        return redirect('/');
    }
    public function gitredirect(){
        return Socialite::driver('github')->with(['prompt' => 'select_account'])->redirect();
    }
    public function gitcallback(){

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

        if(Storage::disk('public')->exists('user'.$user->id.'.jpg')){
            $user->avatar = 'user'.$user->id.'.jpg';
            $user->save();
        }

        Auth::login($user);
        return redirect('/');

    }
    public function logout(){
        Auth::logout();
        return redirect()->route('home');
    }

}
