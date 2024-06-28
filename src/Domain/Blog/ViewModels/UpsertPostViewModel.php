<?php

namespace Domain\Blog\ViewModels;

use Domain\Blog\Models\Category;
use Domain\Blog\Models\Post;
use Domain\Blog\Models\Tag;
use Domain\Blog\Resources\CategoryResource;
use Domain\Blog\Resources\PostResource;
use Domain\Blog\Resources\TagResource;
use Domain\Shared\ViewModels\ViewModel;
use Illuminate\Http\Resources\Json\ResourceCollection;

class UpsertPostViewModel extends ViewModel
{
    public function __construct(public ?Post $post = null)
    {
    }

    public function post(): ?PostResource
    {
        if (!$this->post) {
            return null;
        }

        return new PostResource($this->post->load('category', 'tags'));
    }

    public function categories(): ResourceCollection
    {
        return CategoryResource::collection(Category::all());
    }

    public function tags(): ResourceCollection
    {
        return TagResource::collection(Tag::all());
    }
}
