<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Console\Input\Input;

class UserActionsController
{
    public function post(Request $request){
        $request->validate([
           'upload' => 'required|image|mimes:jpeg,jpg,png,gif',
        ]);

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
            'avatar' => 'image|nullable|mimes:jpeg,png,jpg,gif,svg',
            'banner' => 'image|nullable|mimes:jpeg,png,jpg,gif,svg',
        ]);


        if ($request->hasFile('avatarUpload')) {
            $imageName = "user{$user->id}.".$request->file('avatarUpload')->extension();
            Storage::disk('public')->put(
                $imageName, file_get_contents($request->file('avatarUpload')->getRealPath())
            );
            $user->avatar = $imageName;

        }
        if ($request->hasFile('bannerUpload')) {
            $imageName = "user{$user->id}banner.".$request->file('bannerUpload')->extension();
            Storage::disk('public')->put(
                $imageName, file_get_contents($request->file('bannerUpload')->getRealPath())
            );
            $user->banner = $imageName;

        }
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

    public function like(Request $request)
    {
        $request->validate([
            'post_id' => 'integer',
            'user_id' => 'integer',
        ]);

        $newLike = Like::firstOrCreate([
            'user_id' => Auth::id(),
            'post_id' => $request->input('post_id'),
        ],[
           'user_id' => $request->input('user_id'),
           'post_id' => $request->input('post_id'),
        ]);
        $newLike->save();

        return back();
    }
}
