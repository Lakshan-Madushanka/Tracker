<?php

declare(strict_types=1);

use App\Actions\Error\Solution\UpdateSolutionAction;
use App\Models\Solution;

use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;

it('update a solution for error', function (): void {
    $solution = Solution::factory()->create();
    $error = $solution->error;

    $action = app(UpdateSolutionAction::class);
    $action->execute($error, $solution, ['rank' => 1, 'text' => 'updated text']);

    assertDatabaseCount($solution->getTable(), 1);
    assertDatabaseHas($solution->getTable(), [
        'id' => $solution->getKey(),
        'text' => 'updated text',
        'rank' => 1,
    ]);
});

it('update a solution without rank', function (): void {
    $solution = Solution::factory()->create();
    $error = $solution->error;

    $action = app(UpdateSolutionAction::class);
    $action->execute($error, $solution, [...$solution->toArray(), 'rank' => null]);

    assertDatabaseHas($solution->getTable(), ['id' => $solution->getKey(), 'rank' => $solution->rank]);
});
