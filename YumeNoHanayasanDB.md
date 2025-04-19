> [!DANGER] Remember
> - The User class is missing some of the fields necessary to store the information returned by OAuth2.0
> - Comments should have either a post or a comment as a parent, but never both 


```mermaid
erDiagram

USER{
	int id PK
	varchar(15) username
	varchar(10) pronouns "nullable"
	text biography
	varchar(20) avatar
	varchar(20) banner
}

POST{
	int id PK
	timestamp created_at
	varchar(20) image
	in user_id FK
}

COMMENT{
	int id PK
	text content
	timestamp created_at
	int user_id FK
	int father_post FK "nullable"
	int father_comment FK "nullable"
}

USER ||--|{ POST: ""
USER ||--|{ COMMENT: ""
USER }|--|{ POST: "LIKE"
POST ||--|{ COMMENT: ""

```

### Post migration
```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('image', length: 20);
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
        });
    }
};
```
### Comment migration
```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->tinyText('content');
            $table->unsignedBigInteger('user_id');
            $table->string('father_type', length: 10);
            $table->unsignedBigInteger('father_id');
            $table->timestamps();
        });
    }
};
```
