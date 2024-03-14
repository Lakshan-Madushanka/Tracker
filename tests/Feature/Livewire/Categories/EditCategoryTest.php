<?php

declare(strict_types=1);

use App\Livewire\Categories\EditCategory;
use App\Models\Category;
use Livewire\Livewire;

use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;

it('renders successfully', function (): void {
    Livewire::test(EditCategory::class, ['category' => Category::factory()->create()])
        ->assertStatus(200);
});

it('can update a category', function (): void {
    $category = Category::factory()->create(['name' => 'cat']);

    Livewire::test(EditCategory::class, ['category' => $category])
        ->set('form.name', 'category')
        ->call('save')
        ->assertHasNoErrors(['form.name'])
        ->assertStatus(200);

    $tableName = app(Category::class)->getTable();

    assertDatabaseCount($tableName, 1);
    assertDatabaseHas($tableName, ['name' => 'category']);
});
