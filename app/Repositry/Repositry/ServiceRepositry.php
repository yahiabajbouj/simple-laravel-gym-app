<?php
namespace App\Repositry\Repositry;

use App\Models\Service;
use App\Repositry\IRepositry\IServiceRepositry;

class ServiceRepositry extends BaseRepositry implements IServiceRepositry{
    public function model()
    {
        return Service::class;
    }
}