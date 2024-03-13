<?php

declare(strict_types=1);

use App\Livewire\Solutions\DeleteSolution;
use App\Models\Solution;
use Livewire\Livewire;

use function Pest\Laravel\assertDatabaseEmpty;

it('renders successfully', function (): void {
    $solution = Solution::factory()->create();

    Livewire::test(DeleteSolution::class)
        ->call('delete', $solution->getKey())
        ->assertDispatched('solution-deleted')
        ->assertStatus(200);

    assertDatabaseEmpty($solution->getTable());
});
