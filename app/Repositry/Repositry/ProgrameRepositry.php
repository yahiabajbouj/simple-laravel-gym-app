<?php

namespace App\Repositry\Repositry;

use App\Models\Programe;
use App\Repositry\IRepositry\IProgrameRepositry;
use Illuminate\Support\Facades\Auth;

class ProgrameRepositry extends BaseRepositry implements IProgrameRepositry
{
    public function model()
    {
        return Programe::class;
    }

    public function byUser()
    {
        return Auth::user()->customer->programe;
    }
}
