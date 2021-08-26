<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExercisesType extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'image'];

    public function exercises()
    {
        return $this->hasMany(Exercise::class, 'exercisesTypeId');
    }
}
