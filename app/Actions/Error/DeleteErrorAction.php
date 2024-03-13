<?php

declare(strict_types=1);

namespace App\Actions\Error;

use App\Models\Error;

class DeleteErrorAction
{
    public function execute(string $errorId): bool
    {
        return Error::query()->findOrFail($errorId)->delete();
    }
}
