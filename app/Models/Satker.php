<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SatkerContact;

class Satker extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'image', 'deskripsi', 'visi', 'misi'];

    public function satker_contacts()
    {
        return $this->hasMany(SatkerContact::class);
    }
}
