<?php

declare(strict_types=1);

use App\Livewire\Categories\CreateCategory;
use App\Models\Category;
use Livewire\Livewire;

use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;

it('renders successfully', function (): void {
    Livewire::test(CreateCategory::class)
        ->assertStatus(200);
});

it('can create a category', function (): void {
    Livewire::test(CreateCategory::class)
        ->set('form.name', 'category')
        ->call('save')
        ->assertHasNoErrors(['form.name'])
        ->assertDispatched('category-created')
        ->assertStatus(200);

    $tableName = app(Category::class)->getTable();

    assertDatabaseCount($tableName, 1);
    assertDatabaseHas($tableName, ['name' => 'category']);
});
