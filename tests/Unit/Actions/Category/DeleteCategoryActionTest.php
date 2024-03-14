<?php

declare(strict_types=1);

use App\Actions\Category\DeleteCategoryAction;
use App\Models\Category;

use function Pest\Laravel\assertDatabaseEmpty;

it('can delete a category', function (): void {
    $category = Category::factory()->create();

    app(DeleteCategoryAction::class)->execute($category->getKey());

    $tableName = app(Category::class)->getTable();

    assertDatabaseEmpty($tableName);
});
