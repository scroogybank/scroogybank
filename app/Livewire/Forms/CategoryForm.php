<?php

namespace App\Livewire\Forms;

use App\Enums\CategoryKind;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Form;

class CategoryForm extends Form
{
    public ?Category $category = null;
    public string $kind = '';
    public string $name = '';
    public string $color = '';
    public bool $visible = false;

    public function rules(): array
    {
        return [
            'kind' => [
                'required',
                Rule::in(array_column(CategoryKind::cases(), 'value')),
            ],
            'name' => 'required|string|max:255',
            'color' => 'required|hex_color',
            'visible' => 'boolean',
        ];
    }

    public function setCategory(Category $category): void
    {
        $this->category = $category;
        $this->kind = $category->kind;
        $this->name = $category->name;
        $this->color = $category->color;
        $this->visible = $category->visible;
    }

    public function store(): Category
    {
        $this->validate();

        return Auth::user()->categories()->create($this->all());
    }

    public function update(): void
    {
        $this->validate();

        $this->category->update(
            $this->all()
        );
    }
}
