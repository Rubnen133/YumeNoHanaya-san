<!DOCTYPE html>
<head>
    <title>Yume No Hanaya-san</title>
    <script src="https://code.jquery.com/jquery-3.7.1.slim.js" integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>
    <script>
        function uploadChange(uploadField){
            console.log("wawa1");
            var file = $('#'.concat(uploadField, 'Upload'))[0].files[0].name;
            console.log(file);
            $('#'.concat(uploadField, '-upload-label > p')).text(file);
            console.log("wawa2");
        }
    </script>
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
                    <a class="link-text" href="{{route('profile')}}">Profile</a>
                </div>

                <div class="single-link">
                    <span class="material-icons md-36">bookmark</span>
                    <div class="link-text">Saved</div>
                </div>

                <div class="single-link">
                    <span class="material-icons md-36">favorite</span>
                    <a class="link-text" href="{{route('liked')}}">Liked</a>
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
            <div id="pfp" style="background-image: url(@yield('pfp'))"></div>
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


        <div id="edit">
            <form action="{{route('edit')}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('post')
                <div id="text-fields">
                    <div>
                        <label for="username">Username</label>
                        <input type="text" name="username">
                    </div>
                    <div>
                        <label for="pronouns">Pronouns</label>
                        <input type="text" name="pronouns">
                    </div>
                    <div>
                        <label for="description">Description</label>
                        <textarea name="description" maxlength="255"></textarea>
                    </div>
                </div>
                <div id="image-fields">
                    <div>
                        <label style="grid-column: 1; background-color: #00000000; color: var(--brown);">Avatar</label>
                        <label for="avatar" id="avatar-upload-label">
                            <span class="material-icons md-24">add</span>
                            <p style="padding: 0 10%; margin: 0; grid-column: 2;">Browse files...</p>
                        </label>
                        <input type="file" name="avatarUpload" onchange="uploadChange('avatar')">
                    </div>
                    <div>
                        <label style="grid-column: 1; background-color: #00000000; color: var(--brown);">Banner</label>
                        <label for="banner" id="banner-upload-label">
                            <span class="material-icons md-24">add</span>
                            <p style="padding: 0 10%; margin: 0; grid-column: 2;">Browse files...</p>
                        </label>
                        <input type="file" name="bannerUpload" onchange="uploadChange('banner')">
                    </div>
                </div>
                <input type="submit" name="submit" id="submit">
            </form>
        </div>
    </div>
</body>
