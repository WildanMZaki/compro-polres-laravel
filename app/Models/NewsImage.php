<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Berita;

class NewsImage extends Model
{
    use HasFactory;

    protected $fillable = ['name'];
}
