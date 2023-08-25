<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

interface LinkRepositoryInterface
{
    public function __construct(Model $model);
    public function store($data);
    public function getIdentifier($identifier);
    public function getList();
    public function getLink($link);
    public function get($identifier);
    public function getById($id);
    public function update(array $data, $id);
    public function destroy($id);
}
