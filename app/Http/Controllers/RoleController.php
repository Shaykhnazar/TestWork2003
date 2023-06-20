<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Http\Resources\RoleResource;
use App\Models\Role;
use App\Services\RoleService;

class RoleController extends Controller
{
    protected RoleService $roleService;

    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    public function index(RoleRequest $request)
    {
        return RoleResource::collection($this->roleService->getAll($request));
    }

    public function store(RoleRequest $request)
    {
        return new RoleResource($this->roleService->save($request->validated()));
    }

    public function show(Role $role)
    {
        return new RoleResource($role->load('permissions'));
    }

    public function update(RoleRequest $request, Role $role)
    {
        return new RoleResource($this->roleService->update($request->validated(), $role));
    }

    public function destroy(Role $role)
    {
        $this->roleService->delete($role);
        return $this->jsonResponse(message: 'Ok');
    }
}
