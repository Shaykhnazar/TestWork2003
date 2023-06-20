<?php

namespace App\Http\Controllers;

use App\Http\Requests\PermissionRequest;
use App\Http\Resources\PermissionResource;
use App\Models\Permission;
use App\Services\PermissionService;

class PermissionController extends Controller
{
    protected PermissionService $permissionService;

    public function __construct(PermissionService $permissionService)
    {
        $this->permissionService = $permissionService;
    }

    public function index(PermissionRequest $request)
    {
        return PermissionResource::collection($this->permissionService->getAll($request));
    }

    public function store(PermissionRequest $request)
    {
        return new PermissionResource($this->permissionService->save($request->validated()));
    }

    public function show(Permission $permission)
    {
        return new PermissionResource($permission->load('roles'));
    }

    public function update(PermissionRequest $request, Permission $permission)
    {
        return new PermissionResource($this->permissionService->update($request->validated(), $permission));
    }

    public function destroy(Permission $permission)
    {
        $this->permissionService->delete($permission);

        return $this->jsonResponse(message: 'Ok');
    }
}
