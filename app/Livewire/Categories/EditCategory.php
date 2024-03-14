<?php

declare(strict_types=1);

namespace App\Livewire\Categories;

use App\Actions\Category\UpdateCategoryAction;
use App\Models\Category;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class EditCategory extends Component
{
    public string $type = 'update';

    public CategoryForm $form;

    public function mount(Category $category): void
    {
        $this->form->setCategory($category);
    }

    public function save(UpdateCategoryAction $updateCategoryAction): void
    {
        $this->form->update($updateCategoryAction);

        $this->dispatch('category-updated');
    }

    public function render(): View|Factory|Application
    {
        return view('livewire.categories.create-form');
    }
}
