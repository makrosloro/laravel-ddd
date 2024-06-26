<?php

namespace Domain\Blog\Models;

use Database\Factories\TagFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected static function newFactory()
    {
        return app(TagFactory::class);
    }

}
