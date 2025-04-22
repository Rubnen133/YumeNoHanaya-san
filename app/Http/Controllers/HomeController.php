<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class HomeController
{
    public function index(){
        /*$viewData = [
            "post1" => [
                "image" => "images/pexels-secret-garden-333350-931162.jpg",
                "username" => "Liana Flores",
                "avatar" => "images/pfp_placeholder.jpg",
            ],
            "post2" => [
                "image" => "images/girlWithFlower.jpg",
                "username" => "Liana Flores",
                "avatar" => "images/pfp_placeholder.jpg",
            ],
            "post3" => [
                "image" => "images/bouquetCandles.jpg",
                "username" => "Liana Flores",
                "avatar" => "images/pfp_placeholder.jpg",
            ],
        ];*/
        $viewData = [];
        $posts = Post::orderBy('created_at', 'desc')->get();
        foreach ($posts as $post) {
            $user = User::find($post->user_id);
            $viewData[''.$post->id] = [];
            $viewData[''.$post->id]['image'] = $post->image;
            $viewData[''.$post->id]['username'] = $user->name;
            $viewData[''.$post->id]['avatar'] = $user->avatar;
        }
        return view('index')->with('viewData', $viewData);
    }
}
