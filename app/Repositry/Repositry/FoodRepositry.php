<?php
namespace App\Repositry\Repositry;

use App\Models\Food;
use App\Repositry\IRepositry\IFoodRepositry;

class FoodRepositry extends BaseRepositry implements IFoodRepositry{
    public function model()
    {
        return Food::class;
    }
}