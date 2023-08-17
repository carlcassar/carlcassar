<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'table_of_contents',
        'content',
        'image',
        'tags',
        'published_at',
        'deleted_at',
        'created_at',
        'updated_at',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function scopePublished(Builder $query): void
    {
        $query->where('published_at', '<=', now());
    }

    public function getCasts()
    {
        return [
            'published_at' => 'datetime',
        ];
    }
}
