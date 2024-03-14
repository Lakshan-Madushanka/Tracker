<?php

declare(strict_types=1);

namespace App\Livewire\Categories;

use App\ViewModels\Category\GetCategoriesViewModel;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class CategoryList extends Component
{
    public function render(): View|Factory|Application
    {
        return view('livewire.categories.category-list', app(GetCategoriesViewModel::class));
    }
}
