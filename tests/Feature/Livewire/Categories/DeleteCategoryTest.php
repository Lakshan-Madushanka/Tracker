<?php

declare(strict_types=1);

use App\Livewire\Categories\DeleteCategory;
use App\Models\Category;
use Livewire\Livewire;

use function Pest\Laravel\assertDatabaseEmpty;

it('renders successfully', function (): void {
    Livewire::test(DeleteCategory::class)
        ->assertStatus(200);
});

it('can delete a category', function (): void {
    $category = Category::factory()->create();

    Livewire::test(DeleteCategory::class)
        ->call('delete', $category->getKey())
        ->assertDispatched('category-deleted')
        ->assertStatus(200);

    $tableName = app(Category::class)->getTable();

    assertDatabaseEmpty($tableName);
});
