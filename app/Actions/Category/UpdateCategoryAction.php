<?php

declare(strict_types=1);

namespace App\Actions\Category;

use App\Models\Category;

class UpdateCategoryAction
{
    public function execute(Category $category, array $data): bool
    {
        return $category->fill($data)->save();
    }
}
