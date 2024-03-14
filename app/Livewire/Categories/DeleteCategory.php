<?php

declare(strict_types=1);

namespace App\Livewire\Categories;

use App\Actions\Category\DeleteCategoryAction;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class DeleteCategory extends Component
{
    public function delete(DeleteCategoryAction $deleteCategoryAction, string $categoryId): void
    {
        $deleteCategoryAction->execute($categoryId);

        $this->dispatch('category-deleted');
    }

    public function render(): View|Factory|Application
    {
        return view('livewire.categories.delete-category');
    }
}
