<?php

declare(strict_types=1);

namespace App\ViewModels\Category;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Spatie\ViewModels\ViewModel;

class GetCategoriesViewModel extends ViewModel
{
    public function __construct()
    {
        //
    }

    /**
     * @return Collection<int, Category>
     */
    public function categories(): Collection
    {
        return Category::query()
            ->orderBy('name')
            ->get();
    }
}
