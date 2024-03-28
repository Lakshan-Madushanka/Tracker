<?php

declare(strict_types=1);

namespace App\Actions\Solution;

use App\Actions\Error\Solution\UpsertSolutionAction;
use App\Models\Solution;

class DeleteSolutionAction extends UpsertSolutionAction
{
    public function execute(string $solutionId): bool
    {
        return Solution::query()->findOrFail($solutionId)->delete();
    }
}
