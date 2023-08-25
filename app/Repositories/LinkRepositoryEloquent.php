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

    public function getIdentifier($identifier)
    {
        return $this->model->where('identifier', $identifier)->first();
    }

    public function getList()
    {
        return $this->model->all();
    }

    public function getLink($link)
    {
        return $this->model->where('link', $link)->first();
    }

    public function get($identifier)
    {
        return $this->model->where('identifier', $identifier)->first();
    }

    public function getById($id)
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
