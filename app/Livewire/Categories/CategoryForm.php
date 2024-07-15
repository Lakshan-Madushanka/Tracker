<?php

declare(strict_types=1);

namespace App\Livewire\Categories;

use App\Actions\Category\CreateCategoryAction;
use App\Actions\Category\UpdateCategoryAction;
use App\Models\Category;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CategoryForm extends Form
{
    public Category $category;

    public string $categoryId;

    #[Validate(['string', 'required', 'unique:categories'])]
    public string $name = '';

    public function setCategory(Category $category): void
    {
        $this->category = $category;

        $this->categoryId = $category->getKey();
        $this->name = $category->name;
    }

    public function store(CreateCategoryAction $createCategoryAction): void
    {
        $this->validate();

        $createCategoryAction->execute($this->only('name'));

        $this->resetValidation();
        $this->reset('name');

    }

    public function update(UpdateCategoryAction $updateCategoryAction): void
    {
        $this->validate();

        $updateCategoryAction->execute($this->category, $this->only('name'));

        $this->resetValidation();
    }
}
