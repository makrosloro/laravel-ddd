<?php

namespace Domain\Blog\Filters;

use Domain\Shared\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class TagFilter extends Filter
{

    public function handle(Builder $builder, \Closure $next): Builder
    {
        if (count($this->filter) === 0) {
            return $next($builder);
        }

        $builder->whereHas('tags', fn(Builder $q) => $q->whereIn('id', $this->filter));

        return $next($builder);
    }
}
