<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Http\Resources\RoleResource;
use App\Models\Role;
use App\Services\RoleService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class RoleController extends Controller
{
    public function __construct(protected RoleService $roleService)
    {
    }

    public function index(RoleRequest $request): AnonymousResourceCollection
    {
        return RoleResource::collection($this->roleService->getAll($request));
    }

    public function store(RoleRequest $request): RoleResource
    {
        return new RoleResource($this->roleService->save($request->validated()));
    }

    public function show(Role $role): RoleResource
    {
        return new RoleResource($role->load('permissions'));
    }

    public function update(RoleRequest $request, Role $role): RoleResource
    {
        return new RoleResource($this->roleService->update($request->validated(), $role));
    }

    public function destroy(Role $role): JsonResponse
    {
        $this->roleService->delete($role);
        return $this->jsonResponse(message: 'Ok');
    }
}
