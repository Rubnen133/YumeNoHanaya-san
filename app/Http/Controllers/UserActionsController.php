<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Console\Input\Input;

class UserActionsController
{
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
    public function edit(Request $request){
        $user = Auth::user();
        $request->validate([
            'username' => 'string|max:255|nullable',
            'pronouns' => 'string|max:20|nullable',
            'description' => 'string|max:255|nullable',
            'avatar' => 'image|nullable',
            'banner' => 'image|nullable',
        ]);


        if ($request->hasFile('avatar')) {
            $imageName = "user{$user->id}.".$request->file('avatar')->extension();
            Storage::disk('public')->put(
                $imageName, file_get_contents($request->file('avatar')->getRealPath())
            );
            $user->avatar = $imageName;

        }
        // TODO: add column banner to table user
        /*if ($request->hasFile('banner')) {
            $imageName = "user{$user->id}.".$request->file('banner')->extension();
            Storage::disk('public')->put(
                $imageName, file_get_contents($request->file('banner')->getRealPath())
            );
            $user->banner = $imageName;

        }*/
        if($request->has('username') && $request->get('username') != null){
            $user->name = $request->input('username');
        }
        if($request->has('pronouns') && $request->get('pronouns') != null){
            $user->pronouns = $request->input('pronouns');
        }
        if($request->has('description') && $request->get('description') != null){
            $user->bio = $request->input('description');
        }
        $user->save();
        return redirect()->route('profile');

    }


    public function comment(Request $request){
        $request->validate([
            'content' => 'string|max:255',
            'postid' => 'integer',
        ]);

        $newComment = Comment::create([
            'user_id' => Auth::id(),
            'post_id' => $request->input('postid'),
            'content' => $request->input('content'),
        ]);

        $newComment->save();

        return back();
    }
}
