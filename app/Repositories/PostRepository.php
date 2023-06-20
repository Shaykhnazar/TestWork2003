<?php
namespace App\Repositories;

use App\Models\Post;
use App\Repositories\Interfaces\BaseRepositoryInterface;

class PostRepository implements BaseRepositoryInterface
{
    protected Post $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function getAll($request)
    {
        return $this->post->get();
    }

    public function save(array $data)
    {
        if (!empty($this->post)) {
            $post = new $this->post;
        }
        $this->extractedSaveFields($data, $post);
        $post->created_by = auth()->user()->id;
        $post->save();

        return $post->fresh();
    }

    public function update(array $data, $model)
    {
        $this->extractedSaveFields($data, $model);
        $model->update();

        return $model;
    }

    public function destroy($model)
    {
        return $model->delete();
    }

    /**
     * @param array $data
     * @param mixed $post
     * @return void
     */
    protected function extractedSaveFields(array $data, mixed $post): void
    {
        $post->title = $data['title'];
        $post->content = $data['content'];
    }
}
