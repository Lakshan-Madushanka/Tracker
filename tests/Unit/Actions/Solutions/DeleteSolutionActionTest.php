<?php

declare(strict_types=1);

use App\Actions\Solution\DeleteSolutionAction;
use App\Models\Solution;

use function Pest\Laravel\assertDatabaseEmpty;

it('renders successfully', function (): void {
    $solution = Solution::factory()->create();

    app(DeleteSolutionAction::class)->execute($solution->getKey());

    assertDatabaseEmpty($solution->getTable());
});
