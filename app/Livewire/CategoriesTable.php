<?php

namespace App\Livewire;

use App\Models\Category;
use App\Table\Column;
use Auth;
use Illuminate\Database\Eloquent\Builder;

/**
 * @use Table<Category>
 */
class CategoriesTable extends Table
{
    public function model(): Category
    {
        return app(Category::class);
    }

    public function query(): Builder
    {
        return Auth::user()->categories()->getQuery();
    }

    public function columns(): array
    {
        return [
            Column::make('kind', __('category.kind')),
            Column::make('name', __('category.name')),
            Column::make('show', __('category.show'))->component('columns.navigate'),
        ];
    }
}
