<?php

declare(strict_types=1);

namespace App\Actions\Error\Solution;

use App\Models\Error;

class DeleteAllSolutionsAction extends UpsertSolutionAction
{
    public function execute(string $errorId): void
    {
        Error::query()->findOrFail($errorId)->solutions()->delete();
    }
}
