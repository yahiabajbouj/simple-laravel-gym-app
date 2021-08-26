<?php
namespace App\Repositry\IRepositry;

interface IBase{
    public function all();

    public function create($data);

    function model();
}