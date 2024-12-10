<?php

namespace App\Livewire;

use App\Models\Category;
use App\Table\Column;
use Illuminate\Database\Eloquent\Builder;

class CategoriesTable extends Table
{

    /**
     * @return Builder<Category>
     */
    public function query(): Builder
    {
        return auth()->user()->categories()->getQuery();
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
