<?php

declare(strict_types=1);

use App\Actions\Category\UpdateCategoryAction;
use App\Models\Category;

use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;

it('can update a category', function (): void {
    $category = Category::factory()->create(['name' => 'cat']);

    app(UpdateCategoryAction::class)->execute($category, ['name' => 'category']);

    $tableName = app(Category::class)->getTable();

    assertDatabaseCount($tableName, 1);
    assertDatabaseHas($tableName, ['name' => 'category']);
});
