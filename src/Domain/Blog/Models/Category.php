<?php

namespace Domain\Blog\Models;

use Database\Factories\CategoryFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name'
    ];

    protected static function newFactory()
    {
        return app(CategoryFactory::class);
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }
}
