<?php
namespace App\Repositry\Repositry;

use App\Models\User;
use App\Repositry\IRepositry\IUserRepositry;

class UserRepositry extends BaseRepositry implements IUserRepositry{
    public function model()
    {
        return User::class;
    }
}