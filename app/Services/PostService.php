<?php

namespace App\Services;

use App\Repositories\PostRepository;
use App\Services\Interfaces\CrudInterface;

class PostService implements CrudInterface
{
    protected PostRepository $repository;

    public function __construct(PostRepository $postRepository)
    {
        $this->repository = $postRepository;
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
