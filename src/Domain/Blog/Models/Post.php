<?php

namespace Domain\Blog\Models;

use Database\Factories\PostFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected static function newFactory()
    {
        return app(PostFactory::class);
    }
}
