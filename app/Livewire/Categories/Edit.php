<?php

namespace App\Livewire\Categories;

use App\Enums\CategoryKind;
use App\Livewire\Forms\CategoryForm;
use App\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Livewire\Component;

class Edit extends Component
{
    public Category $category;
    public array $categoryKinds;
    public CategoryForm $form;

    public function mount(): void
    {
        $this->categoryKinds = CategoryKind::cases();
    }

    public function save(): RedirectResponse
    {
        $this->form->update();

        return redirect()->to(route('categories.show', ['category' => $this->category]))
            ->with('status', __('Category updated'));
    }

    public function render(): View
    {
        return view('livewire.categories.form');
    }
}
