<?php
namespace App\Repositry\Repositry;

use App\Models\ExercisesType;
use App\Repositry\Repositry\BaseRepositry;
use App\Repositry\IRepositry\IExercisesTypeRepositry;

class ExercisesTypeRepositry extends BaseRepositry implements IExercisesTypeRepositry{
    public function model()
    {
        return ExercisesType::class;
    }
}