<?php

declare(strict_types=1);

use App\Actions\Category\CreateCategoryAction;
use App\Models\Category;

use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;

it('can create a category', function (): void {
    $data = Category::factory()->make()->toArray();

    app(CreateCategoryAction::class)->execute($data);

    $tableName = app(Category::class)->getTable();

    assertDatabaseCount($tableName, 1);
    assertDatabaseHas($tableName, $data);
});
