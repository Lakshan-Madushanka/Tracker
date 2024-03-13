<?php

declare(strict_types=1);

use App\Livewire\Errors\Solutions\CreateSolution;
use App\Models\Solution;
use Livewire\Livewire;

use function Pest\Laravel\assertDatabaseHas;

it('renders successfully', function (): void {
    Livewire::test(CreateSolution::class)
        ->assertStatus(200);
});

it('can create solution for the error', function (): void {
    $error = App\Models\Error::factory()->create();

    Livewire::test(CreateSolution::class, ['error' => $error])
        ->call('save')
        ->set('form.text', 'solution1')
        ->call('save');

    assertDatabaseHas((new Solution())->getTable(), ['text' => 'solution1']);
});

it('dispatch event after solution created', function (): void {
    $error = App\Models\Error::factory()->create();

    Livewire::test(CreateSolution::class, ['error' => $error])
        ->call('save')
        ->set('form.text', 'solution1')
        ->call('save')
        ->assertDispatched('solution-created');

    assertDatabaseHas((new Solution())->getTable(), ['text' => 'solution1']);
});
