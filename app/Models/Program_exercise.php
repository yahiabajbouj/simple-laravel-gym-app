<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program_exercise extends Model
{
    use HasFactory;
    protected $fillable = ['exerciseId', 'programeId', 'day', 'counters'];
    			
}
