<?php

namespace App\Repositories;

use App\Repositories\LinkRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class LinkRepositoryEloquent implements LinkRepositoryInterface
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

    public function getLink($link)
    {
        return $this->model->where('link', $link)->first();
    }

    public function get($id)
    {
        return $this->model->find($id);
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
