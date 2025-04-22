<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Console\Input\Input;

class UserActionsController
{

    public function logout(){
        Auth::logout();
        return redirect()->route('home');
    }

    public function post(Request $request){
        $newPost = Post::create([
            'user_id' => Auth::id(),
            'image' => 'images/background1.png'
        ]);

        if ($request->hasFile('upload')) {
            $imageName = "post{$newPost->id}.".$request->file('upload')->extension();
            Storage::disk('public')->put(
                $imageName, file_get_contents($request->file('upload')->getRealPath())
            );
            $newPost->image = $imageName;

            $newPost->save();
        }
        return back();
    }
}
