<?php

declare(strict_types=1);

namespace App\Actions\Category;

use App\Models\Category;

class DeleteCategoryAction
{
    public function execute(string $categoryId): bool
    {
        return Category::query()->find($categoryId)->delete();
    }
}
