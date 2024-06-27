<?php

namespace Domain\Blog\Enums;

use Domain\Blog\Filters\CategoryFilter;
use Domain\Blog\Filters\QueryFilter;
use Domain\Blog\Filters\TagFilter;
use Domain\Shared\Filters\Filter;

enum Filters: string
{
    case Query = 'query';
    case Categories = 'categories';
    case Tags = 'tags';

    public function create(array|string $filter): Filter
    {
        return match ($this) {
            self::Query => new QueryFilter($filter),
            self::Categories => new CategoryFilter($filter),
            self::Tags => new TagFilter($filter),
        };
    }

}
