<?php

namespace Domain\Blog\Filters;

use Domain\Shared\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

final class QueryFilter extends Filter
{

    public function handle(Builder $builder, \Closure $next): Builder
    {
        if (!strlen($this->filter)) {
            return $next($builder);
        }

        $builder->where('title', 'like', "%$this->filter%");
        return $next($builder);
    }
}
