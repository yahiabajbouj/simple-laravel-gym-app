<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Images extends Model
{
    use HasFactory;
    protected $fillable = ['path', 'images_id', 'images_type'];

    public function images()
    {
        return $this->morphTo();
    }
}
