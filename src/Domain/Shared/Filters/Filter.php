<?php

namespace Domain\Shared\Filters;

use Illuminate\Database\Eloquent\Builder;

abstract class Filter
{
    public function __construct(protected array|string $filter)
    {
    }

    abstract public function handle(Builder $items, \Closure $next): Builder;

}
