<?php

namespace App\Http\Controllers;

use App\Http\Requests\PermissionRequest;
use App\Http\Resources\PermissionResource;
use App\Models\Permission;
use App\Services\PermissionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PermissionController extends Controller
{
    public function __construct(protected PermissionService $permissionService)
    {
    }

    public function index(PermissionRequest $request): AnonymousResourceCollection
    {
        return PermissionResource::collection($this->permissionService->getAll($request));
    }

    public function store(PermissionRequest $request): PermissionResource
    {
        return new PermissionResource($this->permissionService->save($request->validated()));
    }

    public function show(Permission $permission): PermissionResource
    {
        return new PermissionResource($permission->load('roles'));
    }

    public function update(PermissionRequest $request, Permission $permission): PermissionResource
    {
        return new PermissionResource($this->permissionService->update($request->validated(), $permission));
    }

    public function destroy(Permission $permission): JsonResponse
    {
        $this->permissionService->delete($permission);
        return $this->jsonResponse(message: 'Ok');
    }
}
