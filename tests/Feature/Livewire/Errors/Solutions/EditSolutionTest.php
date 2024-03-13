<?php

declare(strict_types=1);

use App\Livewire\Errors\Solutions\EditSolution;
use App\Models\Solution;
use Livewire\Livewire;

use function Pest\Laravel\assertDatabaseHas;

it('renders successfully', function (): void {
    $solution = Solution::factory()->create();
    $error = $solution->error;

    Livewire::test(EditSolution::class, ['error' => $error, 'solution' => $solution])
        ->assertStatus(200);
});

it('can create solution for the error and dispatch event', function (): void {
    $solution = Solution::factory()->create();
    $error = $solution->error;

    Livewire::test(EditSolution::class, ['error' => $error, 'solution' => $solution])
        ->call('save')
        ->set('form.text', 'solution1')
        ->set('form.rank', 1)
        ->call('save')
        ->assertDispatched('solution-updated');

    assertDatabaseHas((new Solution())->getTable(), [
        'id' => $solution->getKey(),
        'rank' => 1,
        'text' => 'solution1',
    ]);
});
