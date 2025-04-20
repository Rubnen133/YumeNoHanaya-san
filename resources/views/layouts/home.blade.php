<!DOCTYPE html>
<head>
    <title>Yume No Hanaya-san</title>
    <link rel="stylesheet" href="{{asset("home.css")}}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        .material-icons.md-18 { font-size: .6rem; }
        .material-icons.md-24 { font-size: .8rem; }
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
                    <div class="link-text">Home</div>
                </div>

                <div class="single-link">
                    <span class="material-icons md-36">account_circle</span>
                    <a class="link-text" href="{{route('git_redirect')}}">Profile</a>
                </div>

                <div class="single-link">
                    <span class="material-icons md-36">bookmark</span>
                    <div class="link-text">Saved</div>
                </div>

                <div class="single-link">
                    <span class="material-icons md-36">favorite</span>
                    <div class="link-text">Liked</div>
                </div>
            </div>
            <div class="sidebar-line"></div>
        </div>
        <div id="sidebar-bottom">
            @if(\Illuminate\Support\Facades\Auth::user() == null)
                <div style="grid-column: 2">Not logged in</div>
            @else
                <img src="{{Auth::user()->avatar}}" alt="" id="sidebar-pfp">
                <div>
                    @yield("username")
                </div>
            @endguest
        </div>
    </div>
    <div id="feed-wrapper">
        <div id="feed">
            @yield("posts")
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
