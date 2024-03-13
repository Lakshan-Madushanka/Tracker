<?php

declare(strict_types=1);

use App\Actions\Error\Solution\CreateSolutionAction;
use App\Models\Solution;

use function Pest\Laravel\assertDatabaseHas;

it('create a solution for error', function (): void {
    $error = App\Models\Error::factory()->create();
    $solution = Solution::factory()->make();
    $solutionData = $solution->toArray();
    unset($solutionData['error_id']);

    $action = app(CreateSolutionAction::class);
    $action->execute($error, $solutionData);

    $expectedData = $solutionData;
    $expectedData['error_id'] = $error->getKey();

    assertDatabaseHas($solution->getTable(), $expectedData);
});

it('create a solution without rank', function (): void {
    $error = App\Models\Error::factory()->create();
    $solution = Solution::factory()->make();
    $solutionData = $solution->toArray();
    unset($solutionData['error_id'], $solutionData['rank']);

    $action = app(CreateSolutionAction::class);
    $action->execute($error, $solutionData);

    $expectedData = $solutionData;
    $expectedData['error_id'] = $error->getKey();
    $expectedData['rank'] = 1;

    assertDatabaseHas($solution->getTable(), $expectedData);
});

it('create a solution with correct rank', function (): void {
    $error = App\Models\Error::factory()->has(Solution::factory()->state(['rank' => 2]))->create();

    $solution = Solution::factory()->make();
    $solutionData = $solution->toArray();
    unset($solutionData['error_id'], $solutionData['rank']);

    $action = app(CreateSolutionAction::class);
    $action->execute($error, $solutionData);

    $expectedData = $solutionData;
    $expectedData['error_id'] = $error->getKey();
    $expectedData['rank'] = 3;

    assertDatabaseHas($solution->getTable(), $expectedData);
});
