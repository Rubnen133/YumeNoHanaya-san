<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
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
            'banner' => $user->banner ?? null,
        ];

        if (Str::startsWith($user->avatar, 'http')) {
            $viewData['avatar'] = $user->avatar;
        }else{
            $viewData['avatar'] = 'storage/'.$user->avatar;
        }


        $viewData['posts'] = $user->posts->sortByDesc('created_at');

        return view('profile')->with('viewData', $viewData);
    }

    public function liked(){
        $viewData = [];
        $loggedUserAvatar = Auth::user()->avatar;
        if (!Str::startsWith($loggedUserAvatar, 'http')) {
            $loggedUserAvatar = 'storage/' .$loggedUserAvatar;
        }
        $likes = Like::where('user_id', Auth::id())->get('post_id');
        $like_ids = [];
        foreach ($likes as $like) {
            $like_ids[] = $like->post_id;
        }
        $posts = Post::orderBy('created_at', 'desc')->whereIn('id', $like_ids)->get();
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

        return view('liked')
            ->with('viewData', $viewData)
            ->with('loggedUserAvatar', $loggedUserAvatar ?? "");
    }
}
