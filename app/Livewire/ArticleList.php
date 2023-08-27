<?php

namespace App\Livewire;

use App\Models\Article;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class ArticleList extends Component
{
    use WithPagination;

    #[Url]
    public string $tag = '';


    #[Url]
    public string $year = '';

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
