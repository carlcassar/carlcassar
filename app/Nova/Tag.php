<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Inspheric\Fields\Url;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Slug;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Timothyasp\Color\Color;

class Tag extends Resource
{
    public static $model = \App\Models\Tag::class;

    public static $title = 'name';

    public static $search = [
        'id',
        'name'
    ];

    public function fields(Request $request)
    {
        return [
            ID::make( 'id')->sortable(),

            Text::make('Name')
                ->rules('required', 'min:2', 'max:255'),

            Slug::make('Slug')
                ->from('Name')
                ->onlyOnForms()
                ->rules('required', 'min:2', 'max:255'),

            Color::make('Colour')
                ->rules('required', 'min:7', 'max:7'),

            Url::make('Preview', fn () => route('tags.show', $this->resource))
                ->clickable()
                ->onlyOnDetail(),
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
