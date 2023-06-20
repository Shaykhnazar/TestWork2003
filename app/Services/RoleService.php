<?php

namespace App\Services;

use App\Repositories\RoleRepository;
use App\Services\Interfaces\CrudInterface;

class RoleService implements CrudInterface
{
    protected RoleRepository $repository;

    public function __construct(RoleRepository $roleRepository)
    {
        $this->repository = $roleRepository;
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
