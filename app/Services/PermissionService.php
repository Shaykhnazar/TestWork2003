<?php

namespace App\Services;

use App\Repositories\PermissionRepository;
use App\Services\Interfaces\CrudInterface;

class PermissionService implements CrudInterface
{
    protected PermissionRepository $repository;

    public function __construct(PermissionRepository $permissionRepository)
    {
        $this->repository = $permissionRepository;
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
