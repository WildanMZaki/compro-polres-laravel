<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Comment;

class Berita extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'image', 'content'];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
