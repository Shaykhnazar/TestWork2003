<?php

namespace App\Repositories;

use App\Models\Permission;
use App\Repositories\Interfaces\BaseRepositoryInterface;

class PermissionRepository implements BaseRepositoryInterface
{
    /**
     * @var Permission
     */
    protected Permission $permission;

    public function __construct(Permission $permission)
    {
        $this->permission = $permission;
    }

    public function getAll($request)
    {
        return $this->permission->includeWith($request['include'])->get();
    }

    public function save(array $data)
    {
        if (!empty($this->permission)) {
            $permission = new $this->permission;
        }
        $this->extractedSaveFields($data, $permission);

        $permission->save();

        return $permission->fresh();
    }

    public function update(array $data, $model)
    {
        $this->extractedSaveFields($data, $model);

        $model->update();

        return $model;
    }

    public function destroy($model)
    {
        return $model->delete();
    }

    /**
     * @param array $data
     * @param mixed $permission
     * @return void
     */
    protected function extractedSaveFields(array $data, mixed $permission): void
    {
        $permission->name = $data['name'];
        $permission->description = $data['description'] ?? null;
    }
}
