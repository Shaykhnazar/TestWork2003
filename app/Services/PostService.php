<?php

namespace App\Services;

use App\Repositories\PostRepository;

class PostService extends BaseCrudService
{
    public function __construct(PostRepository $repository)
    {
        parent::__construct($repository);
    }
}
