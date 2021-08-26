<?php
namespace App\Repositry\Repositry;

use App\Models\Exercise;
use App\Repositry\IRepositry\IExerciseRepositry;

class ExerciseRepositry extends BaseRepositry implements IExerciseRepositry
{
    public function model()
    {
        return Exercise::class;
    }
}
