<?php

namespace App\Repositories;

use App\Repositories\AccessRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class AccessRepositoryEloquent implements AccessRepositoryInterface
{

    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function store($data)
    {
        return $this->model->create($data);
    }

    public function getList()
    {
        return $this->model->all();
    }

    public function get($id)
    {
        return $this->model->find($id);
    }

    public function getAccess()
    {
        return $this->model->all();
    }

    public function update(array $data, $id)
    {
        return $this->model->find($id)->update($data);
    }

    public function destroy($id)
    {
        return $this->model->destroy($id);
    }
}
