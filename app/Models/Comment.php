<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Berita;
use App\Models\User;
use App\Models\CommentLike;
use App\Models\CommentDislike;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['comment', 'user_id', 'is_main'];

    public function berita()
    {
        return $this->belongsTo(Berita::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function likes()
    {
        return $this->hasMany(CommentLike::class);
    }
    public function dislikes()
    {
        return $this->hasMany(CommentDislike::class);
    }
}
