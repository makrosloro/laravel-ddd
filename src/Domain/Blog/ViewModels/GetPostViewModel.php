<?php

namespace Domain\Blog\ViewModels;

use Domain\Blog\Enums\Filters;
use Domain\Blog\Models\Category;
use Domain\Blog\Models\Post;
use Domain\Blog\Models\Tag;
use Domain\Blog\Resources\CategoryResource;
use Domain\Blog\Resources\PostResource;
use Domain\Blog\Resources\TagResource;
use Domain\Shared\ViewModels\ViewModel;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Pipeline\Pipeline;

final class GetPostViewModel extends ViewModel
{
    const PER_PAGE = 10;

    public function posts(bool $paginated = true): ResourceCollection
    {
        $data = app(Pipeline::class)
            ->send(Post::with(['user', 'tags', 'category']))
            ->through(
                collect(self::filters())
                    ->map(
                        fn($value, $key) => Filters::from($key)->create($value)
                    )
                    ->values()
                    ->all()
            )
            ->thenReturn()
            ->latest();

        if ($paginated) {
            return PostResource::collection($data->paginate(self::PER_PAGE));
        }

        return PostResource::collection($data->get());

    }

    public function categories(): ResourceCollection
    {
        return CategoryResource::collection(Category::all());
    }

    public function tags(): ResourceCollection
    {
        return TagResource::collection(Tag::all());
    }

    private static function filters(): array
    {
        return [
            'query' => request('query', ''),
            'categories' => request('categories', []),
            'tags' => request('tags', []),
        ];
    }

    private function initialFilters(): array
    {
        return [
            'query' => '',
            'categories' => [],
            'tags' => [],
        ];
    }
}
