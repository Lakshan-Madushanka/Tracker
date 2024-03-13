<?php

declare(strict_types=1);

use App\Livewire\Errors\Solutions\DeleteAllSolutions;
use App\Models\Error;
use App\Models\Solution;
use Livewire\Livewire;

it('renders successfully', function (): void {
    $error = Error::factory()->has(Solution::factory(5))->create();

    Livewire::test(DeleteAllSolutions::class)
        ->call('deleteAll', $error->getKey())
        ->assertDispatched('all-solutions-deleted')
        ->assertStatus(200);

    expect($error->solutions()->exists())->toBeFalse();
});
