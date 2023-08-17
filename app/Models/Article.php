<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Feed\Feedable;
use Spatie\Feed\FeedItem;
use Str;

class Article extends Model implements Feedable
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

    public function toFeedItem(): FeedItem
    {
        return FeedItem::create([
            'id' => $this->id,
            'title' => $this->title,
            'summary' => $this->description ?? '',
            'updated' => $this->updated_at,
            'link' => route('articles.show', $this),
            'authorName' => 'Carl Cassar',
            'body' => Str::of($this->content)->markdown(),
            //            'image' => $this->image,
        ]);
    }

    public function getFeedItems()
    {
        return static::published()
            ->orderByDesc('published_at')
            ->limit(20)
            ->get();
    }
}
