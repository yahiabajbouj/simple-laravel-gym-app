<?php
namespace App\Repositry\Repositry;

use App\Models\Program_exercise;
use App\Repositry\IRepositry\IProgramExerciseRepositry;

class ProgramExerciseRepositry extends BaseRepositry implements IProgramExerciseRepositry{
    public function model()
    {
        return Program_exercise::class;
    }
}