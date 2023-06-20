<?php

namespace App\Services\Interfaces;

interface CrudInterface
{

    public function getAll($request);

    public function save($data);

    public function update($data, $model);

    public function delete($model);
}
