<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

interface AccessRepositoryInterface
{
    public function __construct(Model $model);
    public function store($data);
    public function getList();
    public function get($id);
    public function getAccess();
    public function update(array $data, $id);
    public function destroy($id);
}
