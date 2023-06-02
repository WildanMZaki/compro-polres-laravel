<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Satker;

class SatkerContact extends Model
{
    use HasFactory;

    protected $fillable = ['type', 'contact'];

    public function satker()
    {
        return $this->belongsTo(Satker::class);
    }
}
