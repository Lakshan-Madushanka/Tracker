<?php

declare(strict_types=1);

namespace App\Actions\Category;

use App\Models\Category;

class CreateCategoryAction
{
    public function execute(array $data): Category
    {
        return Category::query()->create($data);
    }
}
