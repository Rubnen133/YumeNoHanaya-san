[*Yume No Hanaya-san*](https://github.com/Rubnen133/YumeNoHanaya-san) è un social media per la condivisione di immagini di fiori, preferibilemente a toni caldi.

# Framework, linguaggi, software e strumenti utilizzati
Per creare la webapp sono stati usati:
- Laravel 9.0, MVC framework for PHP
- PhpStorm, a JetBrains IDE for PHP developing
- MariaDB/MySQL, used for database creation and visualisation
- HTML/CSS
- Blade, used to inject PHP code into HTML pages, so that they may be dynamically rendered
- JavaScript, expecially the JQuery library (AJAX)
- OAuth2.0, for user authentication
- Git/GitHub, user for versioning and to create the OAuth application necessary for the login process
- Photoshop, user for logo creation
- DaFont
- Figma, used to imagine/sketch frontend design ideas

# Models and Database tables
## User
#### Database Fields  
| Field Name        | Type            | Description                  |
| ----------------- | --------------- | ---------------------------- |
| id                | bigint unsigned | Primary key                  |
| name              | varchar(255)    | User's display name          |
| email             | varchar(255)    | User's email address         |
| email_verified_at | timestamp       | Email verification timestamp |
| git_id            | varchar(255)    | GitHub user ID               |
| git_token         | varchar(255)    | GitHub access token          |
| git_refresh_token | varchar(255)    | GitHub refresh token         |
| avatar            | varchar(255)    | User's avatar URL            |
| remember_token    | varchar(100)    | Laravel remember me token    |
| created_at        | timestamp       | Creation timestamp           |
| updated_at        | timestamp       | Last update timestamp        |
  
### Relationships
```php 

// User has many posts 
public function posts() { return $this->hasMany(Post::class); }

// User has many likes 
public function likes() { return $this->hasMany(Like::class); }

```
  
### Associated Controllers  
- UserPagesController  
- UserActionsController  
## Post Model 
#### Database Fields  
| Field Name | Type            | Description                |
| ---------- | --------------- | -------------------------- |
| id         | bigint unsigned | Primary key                |
| user_id    | bigint unsigned | Foreign key to users table |
| image      | varchar(255)    | Image path or URL          |
| created_at | timestamp       | Creation timestamp         |
| updated_at | timestamp       | Last update timestamp      |

### Relationships

```php 
// Post belongs to a user 
public function user() { return $this->belongsTo(User::class); }

// Post has many comments 
public function comments() { return $this->hasMany(Comment::class); }

// Post has many likes 
public function likes() { return $this->hasMany(Like::class); }
```


## Like Model    
#### Database Fields  
| Field Name | Type            | Description                |
| ---------- | --------------- | -------------------------- |
| id         | bigint unsigned | Primary key                |
| user_id    | bigint unsigned | Foreign key to users table |
| post_id    | bigint unsigned | Foreign key to posts table |
| created_at | timestamp       | Creation timestamp         |
| updated_at | timestamp       | Last update timestamp      |
  
### Relationships

```php 
// Like belongs to a user
public function user() { return $this->belongsTo(User::class); }

// Like belongs to a post
public function post() { return $this->belongsTo(Post::class); }

```
  
## Comment Model  
#### Database Fields  
| Field Name | Type            | Description                |
| ---------- | --------------- | -------------------------- |
| id         | bigint unsigned | Primary key                |
| user_id    | bigint unsigned | Foreign key to users table |
| post_id    | bigint unsigned | Foreign key to posts table |
| content    | text            | Comment content            |
| created_at | timestamp       | Creation timestamp         |
| updated_at | timestamp       | Last update timestamp      |
  
### Relationships
```php  
// Comment belongs to a user  
public function user()  {return $this->belongsTo(User::class);}  
  
// Comment belongs to a post  
public function post()  {return $this->belongsTo(Post::class);}  
```  

# Controllers
## UserActionsController
Manages user interactions and content management.
### Methods

#### `post(Request $request)`

- **Purpose**: Creates new post with image
- **Validation**:
    - : Required, must be image (jpeg, jpg, png, gif) `upload`
- **Actions**:
    - Creates post record
    - Stores uploaded image
- **Returns**: Redirect back
- **Route**: `POST /post`

#### `edit(Request $request)`

- **Purpose**: Updates user profile information
- **Validation**:
```php
[  
    'username' => 'string|max:255|nullable',  
    'pronouns' => 'string|max:20|nullable',  
    'description' => 'string|max:255|nullable',  
    'avatar' => 'image|nullable|mimes:jpeg,png,jpg,gif,svg',  
    'banner' => 'image|nullable|mimes:jpeg,png,jpg,gif,svg',  
]
```

- **Actions**:
    
    - Updates user avatar
    - Updates user banner
    - Updates profile information
- **Returns**: Redirect to profile
- **Route**: `POST /edit`

#### `comment(Request $request)`

- **Purpose**: Creates new comment on post
- **Validation**:
```php
[  
    'content' => 'string|max:255',  
    'postid' => 'integer',  
]
```

- **Actions**: Creates comment record
- **Returns**: Redirect back
- **Route**: `POST /comment`

#### `like(Request $request)`

- **Purpose**: Manages post likes
- **Validation**:
```php
[  
    'post_id' => 'integer',  
    'user_id' => 'integer',  
]
```
- **Actions**: Creates or finds existing like
- **Returns**: Redirect back
- **Route**: `POST /like`

## HomeController

Manages display of home page and post details.

### Methods

#### `index()`

- **Purpose**: Displays home page
- **Route**: `GET /`

#### `detail($id)`

- **Purpose**: Shows detailed view of specific post
- **Parameters**:
    - `id`: Post ID
- **Route**: `GET /detail/{id}`

## UserPagesController

Handles user-related pages.

### Methods

#### `profile()`

- **Purpose**: Displays user profile page
- **Route**: `GET /profile`

#### `liked()`

- **Purpose**: Shows posts liked by user
- **Route**: `GET /liked`

## Middleware Integration

### Protected Routes

The following controllers/methods are protected by : `UserAuthMiddleware`

- UserActionsController (all methods)
- UserPagesController (all methods)
- LoginController (logout method)
# File Upload Handling
### Image Storage
- Images stored in public disk
- Unique naming convention:
    - Posts: `post{id}.{extension}`
    - User avatars: `user{id}.{extension}`
    - User banners: `user{id}banner.{extension}`
# Authentication  
The application uses GitHub OAuth for authentication, as evidenced by the GitHub-related fields in the User model. 
## Routes
### Public Routes
```php
// GitHub OAuth Authentication  
Route::get('/auth/redirect', 'LoginController@gitredirect')->name('git_redirect');  
Route::get('/auth/callback', 'LoginController@gitcallback')->name('git_callback');
```
### Protected Routes
```php
Route::middleware(UserAuthMiddleware::class)->group(function () {  
    Route::get('/logout', 'LoginController@logout')->name("logout");  
    // ... other protected routes  
});
```
## Login Controller
The handles all authentication-related functionality.
### Methods
#### 1. GitHub Redirect
```php
public function gitredirect()
```

- **Purpose**: Initiates the GitHub OAuth flow
- **Actions**: Redirects user to GitHub's authorization page
- **Returns**: Redirect response to GitHub

#### 2. GitHub Callback
```php
public function gitcallback()
```

- **Purpose**: Handles the OAuth callback from GitHub
- **Actions**:
    - Retrieves user information from GitHub
    - Creates or updates user in the database
    - Establishes user session
- **Returns**: Redirect to home page

#### 3. Logout
```php
public function logout()
```

- **Purpose**: Handles user logout
- **Actions**: Terminates the user session
- **Returns**: Redirect to home page

## OAuth 2.0 Implementation
### Configuration
OAuth 2.0 credentials are configured in : `config/services.php`
```php
'github' => [  
    'client_id' => env('GITHUB_CLIENT_ID'),  
    'client_secret' => env('GITHUB_CLIENT_SECRET'),  
    'redirect' => 'http://127.0.0.1:8000/auth/callback',  
],
```
## Required Environment Variables
```php
GITHUB_CLIENT_ID='github_client_id'  
GITHUB_CLIENT_SECRET='github_client_secret'
```
### OAuth 2.0 Flow

1. **Authorization Request**    
    - User clicks login button
    - Application redirects to GitHub's authorization page
    - Route: `/auth/redirect`
2. **User Consent**
    - User authorizes the application on GitHub
    - GitHub displays permissions being requested
3. **Authorization Grant**
    - GitHub redirects back to application with authorization code
    - Route: `/auth/callback`
4. **Token Exchange**
    - Application exchanges authorization code for access token
    - Handled automatically by Laravel Socialite
5. **User Information**
    - Application retrieves user profile using access token
    - Creates/updates local user record
    - Establishes authenticated session

### User Data Storage
The system stores the following GitHub user information:
- GitHub ID
- Access Token
- Name
- Email
- Avatar URL  
# Frontend UI
The frontend was sketched in FIgma, then realized using free assets found online and a handmade logo.
No CSS framework was used.
Figma project can be found [here](https://www.figma.com/design/MZXWSySyZGmqZ6RLmtcS67/Untitled?node-id=0-1&t=d5gguU6SF0jiIrxD-1)
## Palette
```palette
#FFF1EB  
#FBBEA2  
#F08E8F  
#EA5A3C  
#604141 
```
