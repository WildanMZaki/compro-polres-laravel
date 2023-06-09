<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Comment;

class CommentDislike extends Model
{
    use HasFactory;

    protected $fillable = ['user_id'];

    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }
}
