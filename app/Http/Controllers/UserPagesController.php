<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserPagesController
{
    public function profile()
    {
        $user = User::find(Auth::user()->id);
        $viewData = [
            'username' => $user->name,
            'avatar' => $user->avatar,
            'bio' => $user->bio ?? "",
            'pronouns' => $user->pronouns ?? "",
        ];
        return view('profile')->with('viewData', $viewData);
    }
}
