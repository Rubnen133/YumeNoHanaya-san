<!DOCTYPE html>
<head>
    <title>Yume No Hanaya-san</title>
    <link rel="stylesheet" href="profile.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        .material-icons.md-18 { font-size: 18px; }
        .material-icons.md-24 { font-size: 24px; }
        .material-icons.md-36 { font-size: 36px; }
        .material-icons.md-48 { font-size: 48px; }
    </style>
</head>
<body>
    <div id="sidebar">
        <div id="sidebar-top">
            <div id="sidebar-logo">
                <img src="images/png1.png" alt="">
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
                    <div class="link-text">Profile</div>
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
            <img src="@yield('pfp')" alt="" id="sidebar-pfp">
            <div>
                @yield('username')
            </div>
        </div>
    </div>
    <div id="profile">
        <div id="profile-grid">
            <div id="banner" style="background-image: url(@yield('banner'));"></div>
            <div id="pfp" style="background-image: url(@yield('pfp')"></div>
            <div id="info">
                <div id="user-pron">
                    <div id="username">@yield('username')</div>
                    <div id="pronouns">@yield('pronouns')</div>
                </div>
                <div id="description">
                    @yield('description')
                </div>
                <span class="material-icons md-24">edit</span>
            </div>
        </div>
    </div>
</body>
