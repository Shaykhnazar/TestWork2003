<?php

namespace App\Repositories\Interfaces;

interface BaseRepositoryInterface
{
    public function getAll($request);

    public function save(array $data);

    public function update(array $data, $model);

    public function destroy($model);
}
