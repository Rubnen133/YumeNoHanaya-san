<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class HomeController
{
    public function index(){
        $viewData = [
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
        ];
        return view('index')->with('viewData', $viewData);
    }
}
