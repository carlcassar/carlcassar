<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check();
    }

    public function rules()
    {
        return [
            'title' => 'required|min:2|max:255',
            'slug' => 'required|min:2|max:255',
            'body' => 'required_with:published_at',
            'published_at' => 'date|nullable'
        ];
    }
}
