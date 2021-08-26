<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Programe extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'body'];

    public function exercises(){
        return $this->belongsToMany(Exercises::class);
    }

    public function program_exercises(){
        return $this->hasMany(Program_exercise::class, 'programeId');
    }

    public function customer(){
        return $this->hasMany(Customer::class, 'programeId');
    }
}
