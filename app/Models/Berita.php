<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Comment;
use App\Models\User;

class Berita extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'title', 'slug', 'image', 'content'];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function reporter()
    {
        return $this->belongsTo(User::class);
    }
}
