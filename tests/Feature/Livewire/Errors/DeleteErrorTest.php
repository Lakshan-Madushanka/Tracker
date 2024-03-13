<?php

declare(strict_types=1);

use App\Livewire\Errors\DeleteError;
use Livewire\Livewire;

use function Pest\Laravel\assertDatabaseCount;

it('renders successfully', function (): void {
    Livewire::test(DeleteError::class)
        ->assertStatus(200);
});

it('can delete an error', function (): void {
    $error = App\Models\Error::factory()->create();

    Livewire::test(DeleteError::class)
        ->call('delete', $error->getKey())
        ->assertStatus(200);

    assertDatabaseCount($error->getTable(), 0);
});
