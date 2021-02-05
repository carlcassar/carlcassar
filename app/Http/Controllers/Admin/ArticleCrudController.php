<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ArticleRequest;
use App\Models\Article;
use Backpack\CRUD\app\Http\Controllers\CrudController;

class ArticleCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup(): void
    {
        $this->crud->setModel(Article::class);
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/article');
        $this->crud->setEntityNameStrings('article', 'articles');
    }

    protected function setupListOperation(): void
    {
        $this->crud->column('title');
        $this->crud->column('slug');
        $this->crud->column('published_at')->type('check');
        $this->crud->addColumn([
            'label' => 'Published At',
            'type' => 'closure',
            'function' => function(Article $article) {
                return $article->published_at ?? '-';
            }
        ]);
        $this->crud->column('featured')->type('check');
    }

    protected function setupCreateOperation(): void
    {
        $this->crud->setValidation(ArticleRequest::class);

        $this->crud->field('title')->type('text');
        $this->crud->field('slug')->type('text');
        $this->crud->field('body')->type('easymde');
        $this->crud->field('published_at')->type('datetime_picker');
        $this->crud->field('featured')->type('checkbox');
    }

    protected function setupUpdateOperation(): void
    {
        $this->setupCreateOperation();
    }
}
