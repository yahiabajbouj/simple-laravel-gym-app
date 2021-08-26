<?php

namespace App\Repositry\Repositry;

use App\Repositry\IRepositry\ISubscribeRepositry;
use App\Models\ExercisesType;
use App\Models\Subscribe;
use App\Models\User;

class SubscribeRepositry extends BaseRepositry implements ISubscribeRepositry
{
    public function model()
    {
        return Subscribe::class;
    }

    public function byUser($userId)
    {
        return $this->model->where('userId', $userId)->get();
    }

    public function GetUser($id){
        return User::find($this->model->find($id)->userId);
    }
}
