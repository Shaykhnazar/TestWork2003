<?php

namespace App\Services;

use App\Repositories\Interfaces\BaseRepositoryInterface;

abstract class BaseCrudService implements Interfaces\CrudInterface
{

    public function __construct(protected BaseRepositoryInterface $repository)
    {
    }

    public function getAll($request)
    {
        return $this->repository->getAll($request);
    }

    public function save($data)
    {
        return $this->repository->save($data);
    }

    public function update($data, $model)
    {
        return $this->repository->update($data, $model);
    }

    public function delete($model)
    {
        return $this->repository->destroy($model);
    }
}
