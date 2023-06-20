<?php

namespace App\Repositories;

use App\Models\Role;
use App\Repositories\Interfaces\BaseRepositoryInterface;

class RoleRepository implements BaseRepositoryInterface
{
    /**
     * @var Role
     */
    protected Role $role;

    public function __construct(Role $role)
    {
        $this->role = $role;
    }

    public function getAll($request)
    {
        return $this->role->includeWith($request['include'])->get();
    }

    public function save(array $data)
    {
        if (!empty($this->role)) {
            $role = new $this->role;
        }
        $this->extractedSaveFields($data, $role);

        $role->save();
        $role->syncPermissions($data['permissions']);

        return $role->fresh()->load('permissions');
    }

    public function update(array $data, $model)
    {
        $this->extractedSaveFields($data, $model);

        $model->syncPermissions($data['permissions']);
        $model->update();

        return $model->load('permissions');
    }

    public function destroy($model)
    {
        return $model->delete();
    }

    /**
     * @param array $data
     * @param mixed $role
     * @return void
     */
    protected function extractedSaveFields(array $data, mixed $role): void
    {
        $role->name = $data['name'];
        $role->description = $data['description'] ?? null;
    }
}
