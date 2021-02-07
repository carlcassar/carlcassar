<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Str;

class Tag extends Model
{
    use HasFactory, SoftDeletes, CrudTrait;

    protected $fillable = [
        'name',
        'slug',
        'colour'
    ];

    protected $casts = [
        'id' => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();
        static::saving(function ($model) {
            $model->name = Str::title($model->name);
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function scopeForPublishedArticles(Builder $query)
    {
        $query->whereHas('articles', function(Builder $query) {
            $query->published();
        });
    }

    public function articles(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(\App\Models\Article::class);
    }
}
