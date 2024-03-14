<?php

declare(strict_types=1);

namespace App\Livewire\Categories;

use App\Actions\Category\CreateCategoryAction;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class CreateCategory extends Component
{
    public string $type = 'create';

    public CategoryForm $form;

    public function save(CreateCategoryAction $createCategoryAction): void
    {
        $this->form->store($createCategoryAction);

        $this->dispatch('category-created');
    }

    public function render(): View|Factory|Application
    {
        return view('livewire.categories.create-form');
    }
}
