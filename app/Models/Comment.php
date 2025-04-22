<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comments';
    private $id = 'id';
    private $user_id = 'user_id';
    private $father_type = 'father_type';
    private $father_id = 'father_id';
    private $content = 'content';
    private $created_at = 'created_at';
    private $updated_at = 'updated_at';

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getUserId(): string
    {
        return $this->user_id;
    }

    public function setUserId(string $user_id): void
    {
        $this->user_id = $user_id;
    }

    public function getFatherType(): string
    {
        return $this->father_type;
    }

    public function setFatherType(string $father_type): void
    {
        $this->father_type = $father_type;
    }

    public function getFatherId(): string
    {
        return $this->father_id;
    }

    public function setFatherId(string $father_id): void
    {
        $this->father_id = $father_id;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }


    public function user(){
        return $this->belongsTo(User::class);
    }
}
