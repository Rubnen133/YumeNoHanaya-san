<!DOCTYPE html>
<head>
    <title>Yume No Hanaya-san</title>
    <link rel="stylesheet" href="{{asset("home.css")}}">
    <link rel="stylesheet" href="{{asset("comments.css")}}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        .material-icons.md-18 { font-size: .6rem; }
        .material-icons.md-24 { font-size: 1.4rem; }
        .material-icons.md-36 { font-size: 2.2rem; }
        .material-icons.md-48 { font-size: 1.2rem; }
    </style>
</head>
<body>
<div id="sidebar">
    <div id="sidebar-top">
        <div id="sidebar-logo">
            <img src="{{asset("images/png1.png")}}" alt="">
        </div>
        <div id="sidebar-title">
            ユメの<br>花屋さん
        </div>
    </div>
    <div id="sidebar-links-wrapper">
        <div class="sidebar-line"></div>
        <div id="sidebar-links">
            <div class="single-link">
                <span class="material-icons md-36">home</span>
                <a class="link-text" href="{{route('home')}}">Home</a>
            </div>

            <div class="single-link">
                <span class="material-icons md-36">account_circle</span>
                <a class="link-text" href="{{route('profile')}}">Profile</a>
            </div>

            <div class="single-link">
                <span class="material-icons md-36">favorite</span>
                <a class="link-text" href="{{route('liked')}}">Liked</a>
            </div>
        </div>
        <div class="sidebar-line"></div>
    </div>
    <div id="sidebar-bottom">
        @if(\Illuminate\Support\Facades\Auth::user() == null)
            <div style="grid-column: 2">Not logged in</div>
        @else
            <img src="{{$loggedUserAvatar}}" alt="" id="sidebar-pfp">
            <div>
                @yield("username")
                <a href="{{route('logout')}}" class="material-icons md-24" style="margin-left:1rem;">logout</a>
            </div>
        @endguest
    </div>
</div>

<div id="feed-wrapper">
    <div id="feed">
        @yield('post')

        <div id="comments">
            @if(\Illuminate\Support\Facades\Auth::user() != null)
                <form id="new-comment" action="{{route('comment')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <textarea name="content" id="content" placeholder="What are your thoughts on this?"></textarea>
                    <input type="text" name="postid" id="postid" value="@yield('postid')" hidden>
                    <input type="submit" name="submit" id="submit" style="display: block;" value="Post Comment">
                </form>
            @endif

            @yield("comments")
        </div>
    </div>
</div>


<div id="right-side">
    <div id="boxes-wrapper">
        <div class="box box1" style="background-image: url({{asset("images/bouquetLamp.jpg")}});">
        </div>
        <div id="bottom-boxes">
            <div class="box box2" style="background-image: url({{asset("images/bookOnChair.jpg")}});">
            </div>
            <div class="box box3" style="background-image: url({{asset("images/prettyLight.jpg")}});">
            </div>
        </div>
    </div>
</div>
</body>
