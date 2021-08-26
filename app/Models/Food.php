<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'body'];

    public function images()
    {
        return $this->morphMany("App\Models\Images", 'images');
    }
}
