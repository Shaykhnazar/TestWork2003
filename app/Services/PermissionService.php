<?php

namespace App\Services;

use App\Repositories\PermissionRepository;

class PermissionService extends BaseCrudService
{
    public function __construct(PermissionRepository $repository)
    {
        parent::__construct($repository);
    }
}
