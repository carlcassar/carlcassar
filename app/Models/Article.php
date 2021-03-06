<?php

namespace App\Models;

use App\Jobs\GenerateOpenGraphImage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Feed\Feedable;
use Spatie\Feed\FeedItem;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Str;

class Article extends Model implements Feedable, HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia;

    protected $fillable = [
        'icon',
        'slug',
        'body',
        'title',
        'image',
        'featured',
        'description',
        'published_at',
    ];

    protected $casts = [
        'id' => 'integer',
        'featured' => 'boolean',
        'published_at' => 'datetime',
    ];


    protected static function boot()
    {
        parent::boot();
        static::saving(function ($model) {
            $model->title = Str::title($model->title);
        });
        static::saved(function ($model) {
            dispatch(new GenerateOpenGraphImage($model));
        });
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function scopeFeatured(Builder $query): Builder
    {
        return $query->published()->where('featured', true);
    }

    public function scopeNotFeatured(Builder $query): Builder
    {
        return $query->published()->where('featured', false);
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->whereNotNull('published_at')->orderBy('published_at', 'desc');
    }

    public function scopeTags(Builder $query, $tags): Builder
    {
        return $query->whereHas('tags', function (Builder $query) use ($tags) {
            $query->whereKey($tags->map->id);
        });
    }

    public function scopeSimilarTo(Builder $query, Article $article): Builder
    {
        return $query->whereKeyNot($article->id)->tags($article->tags);
    }

    public function scopeSearch(Builder $query, $search): Builder
    {
        return $search ? $query
            ->where('title', 'LIKE', "%{$search}%")
            ->orWhere('description', 'LIKE', "%{$search}%")
            ->orWhere('body', 'LIKE', "%{$search}%")
            ->orWhereHas('tags', function ($query) use ($search) {
                $query->where('name', 'LIKE', "%{$search}%");
            }) : $query;
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function primaryTag(): BelongsTo
    {
        return $this->belongsTo(Tag::class);
    }

    public function getLinkAttribute()
    {
        return route('articles.show', $this);
    }

    public function toFeedItem(): FeedItem
    {
        return FeedItem::create([
            'id' => $this->id,
            'title' => $this->title,
            'summary' => $this->description,
            'updated' => $this->updated_at,
            'link' => $this->link,
            'author' => 'Carl Cassar',
            'body' => Str::of($this->body)->markdown(),
            'image' => $this->image
        ]);
    }

    public function getFeedItems()
    {
        return static::published()
            ->orderByDesc('published_at')
            ->limit(20)
            ->get();
    }

    public function getFeaturedFeedItems()
    {
        return static::featured()
            ->orderByDesc('published_at')
            ->limit(20)
            ->get();
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('openGraphImage')
            ->useDisk('s3')
            ->singleFile();
    }

    public function isPublished()
    {
        return !is_null($this->published_at);
    }

    public function getOpenGraphImageAttribute()
    {
        $path = $this->getFirstMediaPath('openGraphImage');

        return $path ? 'https://media.carlcassar.com/' . $path : null;
    }
}
