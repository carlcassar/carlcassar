<?php

namespace App\Livewire;

use App\Models\Article;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\Features\SupportQueryString\Url;
use Livewire\WithPagination;
use Str;

class ArticleList extends Component
{
    use WithPagination;

    #[Url]
    public $tag = '';


    #[Url]
    public $year = '';

    public function render()
    {
        return view('livewire.article-list', [
            'articles' => Article::published()
                ->when($this->tag, function (Builder $query) {
                    $query->where('tags', 'LIKE', '%'.$this->tag.'%');
                })
                ->when($this->year, function (Builder $query) {
                    $query->whereYear('published_at', $this->year);
                })
                ->orderByDesc('published_at')
                ->paginate(5),
        ]);
    }
}
