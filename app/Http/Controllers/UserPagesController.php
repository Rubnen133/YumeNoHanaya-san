<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UserPagesController
{
    public function profile()
    {
        $user = User::find(Auth::user()->id);
        $viewData = [
            'username' => $user->name,
            'bio' => $user->bio ?? "",
            'pronouns' => $user->pronouns ?? "",
        ];

        if (Str::startsWith($user->avatar, 'http')) {
            $viewData['avatar'] = $user->avatar;
        }else{
            $viewData['avatar'] = 'storage/'.$user->avatar;
        }
        return view('profile')->with('viewData', $viewData);
    }
}
