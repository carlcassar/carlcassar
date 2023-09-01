<?php

namespace App\Livewire;

use App\Models\Article;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class SearchArticles extends Component
{
    public string $search = '';

    public string $classes = '';

    public function render()
    {
        return view('livewire.search-articles', [
            'articles' => $this->getArticles(),
        ]);
    }

    /**
     * @return array|Builder[]|Collection
     */
    private function getArticles(): array|Collection
    {
        return $this->search
            ? Article::query()
                ->where('title', 'LIKE', '%'.$this->search.'%')
                ->orWhere('content', 'LIKE', '%'.$this->search.'%')
                ->orWhere('tags', 'LIKE', '%'.$this->search.'%')
                ->orderBy('published_at')
                ->limit(10)
                ->get()
            : [];
    }
}
