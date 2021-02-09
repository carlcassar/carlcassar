<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Inspheric\Fields\Url;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Markdown;
use Laravel\Nova\Fields\Slug;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Article extends Resource
{
    public static $model = \App\Models\Article::class;

    public static $title = 'title';

    public static $search = [
        'id',
        'title',
        'body',
    ];

    public function fields(Request $request)
    {
        return [
            ID::make('id')->sortable(),

            Text::make('Title')
                ->rules('required', 'min:2', 'max:255'),

            Slug::make('Slug')
                ->from('Title')
                ->onlyOnForms()
                ->rules('required', 'min:2', 'max:255'),

            Text::make('Image')
                ->rules('min:2', 'max:255')
                ->hideFromIndex(),

            Markdown::make('Description')
                ->rules('required_with:published_at')
                ->hideFromIndex(),

            Markdown::make('Body')
                ->rules('required_with:published_at')
                ->hideFromIndex(),

            Text::make('Icon')
                ->rules('required')
                ->hideFromIndex(),

            BelongsTo::make('Primary Tag', 'primaryTag', Tag::class)
                ->searchable()
                ->withoutTrashed(),

            DateTime::make('Published At')
                ->rules('date', 'nullable')
                ->format('DD-MM-YYYY HH:mm')
                ->pickerDisplayFormat('d-m-Y h:i')
                ->nullable()
                ->hideFromIndex(),

            Boolean::make('Published', 'published_at')->onlyOnIndex(),

            Url::make('Preview', fn () => route('articles.show', $this->resource))
                ->clickable()
                ->onlyOnDetail()
                ->showOnDetail(fn() => $this->resource->isPublished()),

            Boolean::make('Featured'),

            BelongsToMany::make('Tags'),
        ];
    }

    public function cards(Request $request)
    {
        return [];
    }

    public function filters(Request $request)
    {
        return [];
    }

    public function lenses(Request $request)
    {
        return [];
    }

    public function actions(Request $request)
    {
        return [];
    }
}
