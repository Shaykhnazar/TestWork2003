<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Services\PostService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PostController extends Controller
{
    public function __construct(protected PostService $postService)
    {
    }

    public function index(Request $request): AnonymousResourceCollection
    {
        return PostResource::collection($this->postService->getAll($request));
    }

    public function store(PostRequest $request): PostResource
    {
        return new PostResource($this->postService->save($request->validated()));
    }

    public function show(Post $post): PostResource
    {
        return new PostResource($post);
    }

    public function update(PostRequest $request, Post $post): PostResource
    {
        return new PostResource($this->postService->update($request->validated(), $post));
    }

    public function destroy(Post $post): JsonResponse
    {
        $this->postService->delete($post);
        return $this->jsonResponse(message: 'Ok');
    }
}
