<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class HomeController
{
    public function index(){
        $viewData = [];
        if(Auth::user()){
            $loggedUserAvatar = Auth::user()->avatar;
            if (!Str::startsWith($loggedUserAvatar, 'http')) {
                $loggedUserAvatar = 'storage/' .$loggedUserAvatar;
            }
            $likes = Auth::user()->likes()->get('post_id');
            $like_ids = [];
            foreach ($likes as $like) {
                $like_ids[] = $like->post_id;
            }
        }
        $posts = Post::orderBy('created_at', 'desc')->get();
        foreach ($posts as $post) {
            $user = User::find($post->user_id);
            $viewData[''.$post->id] = [];
            $viewData[''.$post->id]['id'] = $post->id;
            $viewData[''.$post->id]['image'] = $post->image;
            $viewData[''.$post->id]['username'] = $user->name;
            if (Str::startsWith($user->avatar, 'http')) {
                $viewData[''.$post->id]['avatar'] = $user->avatar;
            }else{
                $viewData[''.$post->id]['avatar'] = 'storage/'.$user->avatar;
            }
        }

        return view('index')
            ->with('viewData', $viewData)
            ->with('loggedUserAvatar', $loggedUserAvatar ?? "")
            ->with('like_ids', $like_ids ?? []);
    }

    public function detail($id){
        $viewData = [];
        if(Auth::user()){
            $loggedUserAvatar = Auth::user()->avatar;
            if (!Str::startsWith($loggedUserAvatar, 'http')) {
                $loggedUserAvatar = asset('storage/' .$loggedUserAvatar);
            }

            $likes = Auth::user()->likes()->get('post_id');
            $like_ids = [];
            foreach ($likes as $like) {
                $like_ids[] = $like->post_id;
            }
        }

        $post = Post::find($id);
        $user = User::find($post->user_id);
        $viewData = [];
        $viewData['id'] = $post->id;
        $viewData['image'] = $post->image;
        $viewData['username'] = $user->name;
        if (Str::startsWith($user->avatar, 'http')) {
            $viewData['avatar'] = $user->avatar;
        }else {
            $viewData['avatar'] = 'storage/'.$user->avatar;
        }
        $viewData['comments'] = $post->comments;
        return view('detail')
            ->with('viewData', $viewData)
            ->with('loggedUserAvatar', $loggedUserAvatar ?? "")
            ->with('like_ids', $like_ids ?? []);
    }
}
