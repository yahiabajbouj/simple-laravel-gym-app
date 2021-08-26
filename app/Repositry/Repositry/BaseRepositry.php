<?php

namespace App\Repositry\Repositry;

use Illuminate\Container\Container as App;
use App\Repositry\IRepositry\IBase;

abstract class BaseRepositry implements IBase
{
    protected $model;

    public function __construct(App $app)
    {
        $this->app = $app;
        $this->model = $this->app->make($this->model());
    }

    public function all()
    {
        return $this->model->all();
    }

    public function find($id){
        return $this->model->find($id);
    }

    public function create($data)
    {
        return $this->model->create($data);
    }

    public function update($data, $id)
    {
        $this->model->find($id)->update($data);
    }

    public function delete($id)
    {
        return $this->model->find($id)->delete();
    }

    abstract function model();
}
