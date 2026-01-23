<?php

namespace App\Filament\Widgets;

use App\Models\Article;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;

class ArticlesChart extends ChartWidget
{
//    protected static ?string $heading = 'Articles';

    protected function getData(): array
    {
        $articles = Article::selectRaw('COUNT(*) as count, YEAR(published_at) as year, MONTH(published_at) as month')
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Articles Created',
                    'data' => $articles->pluck('count'),
                ],
            ],
            'labels' => $articles->map(function ($item) {
                return Carbon::createFromDate($item['year'], $item['month'], 1)->format('M Y');
            }),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
