<?php

namespace App\Services;

use App\Repositories\RoleRepository;

class RoleService extends BaseCrudService
{
    public function __construct(RoleRepository $repository)
    {
        parent::__construct($repository);
    }
}
