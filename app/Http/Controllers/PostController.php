<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Services\PostService;
use Illuminate\Http\Request;

class PostController extends Controller
{
    protected PostService $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function index(Request $request)
    {
        return PostResource::collection($this->postService->getAll($request));
    }

    public function store(PostRequest $request)
    {
        return new PostResource($this->postService->save($request->validated()));
    }

    public function show(Post $post)
    {
        return new PostResource($post);
    }

    public function update(PostRequest $request, Post $post)
    {
        return new PostResource($this->postService->update($request->validated(), $post));
    }

    public function destroy(Post $post)
    {
        $this->postService->delete($post);
        return $this->jsonResponse(message: 'Ok');
    }
}
