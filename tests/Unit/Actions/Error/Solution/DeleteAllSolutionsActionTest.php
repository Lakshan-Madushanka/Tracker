<?php

declare(strict_types=1);

use App\Actions\Error\Solution\DeleteAllSolutionsAction;
use App\Models\Solution;
use App\Models\Error;

it('create a solution for error', function (): void {
    $error = Error::factory()->has(Solution::factory(5))->create();

    $action = app(DeleteAllSolutionsAction::class);
    $action->execute($error->getKey());

    expect($error->solutions()->exists())->toBeFalse();
});
