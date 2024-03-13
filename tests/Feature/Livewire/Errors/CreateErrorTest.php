<?php

declare(strict_types=1);

use App\Livewire\Errors\CreateError;
use App\Models\Category;
use App\Models\Error;
use Livewire\Livewire;

use function Pest\Laravel\assertDatabaseHas;

it('renders successfully', function (): void {
    Livewire::test(CreateError::class)
        ->assertStatus(200);
});

it('can create an error', function (): void {
    $category = Category::factory()->create();
    $error = Error::factory()->make(['category_id' => $category->getKey()]);

    Livewire::test(CreateError::class, ['categories' => Category::all()])
        ->set('form.category_id', $error->category_id)
        ->set('form.name', $error->name)
        ->set('form.stack_trace', $error->stack_trace)
        ->set('form.project_name', $error->project_name)
        ->set('form.project_url', $error->project_url)
        ->call('save')
        ->assertHasNoErrors()
        ->assertDispatched('error-created');

    assertDatabaseHas((new Error())->getTable(), $error->toArray());

});
