<?php

declare(strict_types=1);

use App\Livewire\Errors\EditError;
use App\Models\Category;
use App\Models\Error;
use Livewire\Livewire;

it('can edit an error', function (): void {
    $category = Category::factory()->create();
    $error = Error::factory()->create();

    Livewire::test(EditError::class, ['categories' => Category::all(), 'error' => $error])
        ->set('form.category_id', $category->getKey())
        ->set('form.name', $error->name)
        ->set('form.stack_trace', $error->stack_trace)
        ->set('form.project_name', $error->project_name)
        ->set('form.project_url', $error->project_url)
        ->call('save')
        ->assertHasNoErrors()
        ->assertDispatched('error-edited');

    expect($error->fresh())
        ->name->toBe($error->name);
});
