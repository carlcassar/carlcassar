<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\TagRequest;
use App\Models\Tag;
use Backpack\CRUD\app\Http\Controllers\CrudController;

class TagCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup(): void
    {
        $this->crud->setModel(Tag::class);
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/tag');
        $this->crud->setEntityNameStrings('tag', 'tags');
    }

    protected function setupListOperation(): void
    {
        $this->crud->column('name')->type('text')->wrapper([
            'href' => fn($crud, $column, $entry, $related_key) => backpack_url('tag/' . $entry->id . '/edit')
        ]);
        $this->crud->column('slug')->type('slug');
        $this->crud->column('colour')->type('color');
    }

    protected function setupCreateOperation(): void
    {
        $this->crud->setValidation(TagRequest::class);

        $this->crud->field('name')->type('text');
        $this->crud->field('slug')->type('text');
        $this->crud->field('colour')->type('color_picker');
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
