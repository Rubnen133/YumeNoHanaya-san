@extends('layouts.home')
@section('posts')
    @foreach($viewData as $post)
    <div class="post">
        <div class="post-top">
            <img src="{{$post['avatar']}}" alt="" class="avatar">
            <p class="username">{{$post['username']}}</p>
        </div>
        <img src="{{asset("storage/{$post['image']}")}}" alt="" class="post-img">
        <div class="post-bottom">
            <div class="post-interaction">
                <a id="a{{$post['id']}}" onclick="like({{$post['id']}})" class="material-icons md-36" style="
                        @if(\Illuminate\Support\Facades\Auth::user() != null)
                            @if(in_array($post['id'], $like_ids))
                                color: var(--accent-red) !important;
                            @endif
                        @endif
                ">favorite</a>

                <a  href="{{route('detail', ['id'=>$post['id']])}}" class="material-icons md-36">comment</a>
            </div>
        </div>
    </div>
    @endforeach
    <!--
    <div class="post">
        <div class="post-top">
            <img src="{{asset("images/pfp_placeholder.jpg")}}" alt="" class="avatar">
            <p class="username">Liana Flores</p>
        </div>
        <img src="{{asset("images/girlWithFlower.jpg")}}" alt="" class="post-img">
        <div class="post-bottom">
            <div class="post-interaction">
                <span class="material-icons md-36">favorite</span>
                <span class="material-icons md-36">comment</span>
            </div>
        </div>
    </div>
    <div class="post">
        <div class="post-top">
            <img src="{{asset("images/pfp_placeholder.jpg")}}" alt="" class="avatar">
            <p class="username">Liana Flores</p>
        </div>
        <img src="{{asset("images/bouquetCandles.jpg")}}" alt="" class="post-img">
        <div class="post-bottom">
            <div class="post-interaction">
                <span class="material-icons md-36">favorite</span>
                <span class="material-icons md-36">comment</span>
            </div>
        </div>
    </div>
    -->

@endsection
@if(\Illuminate\Support\Facades\Auth::user() != null)
    @section('username', \Illuminate\Support\Facades\Auth::user()->name)
@endif
