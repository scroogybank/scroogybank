<?php

namespace App\Livewire\Categories;

use App\Enums\CategoryKind;
use App\Livewire\Forms\CategoryForm;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Create extends Component
{
    public array $categoryKinds;
    public CategoryForm $form;

    public function mount(): void
    {
        $this->categoryKinds = CategoryKind::cases();
    }

    public function save()
    {
        $category = $this->form->store();

        return redirect()->to(route('categories.show', ['category' => $category]))
            ->with('status', __('Category created'));
    }

    public function render(): View
    {
        return view('livewire.categories.form');
    }
}
