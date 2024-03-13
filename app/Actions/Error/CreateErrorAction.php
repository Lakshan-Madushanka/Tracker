<?php

declare(strict_types=1);

namespace App\Actions\Error;

use App\Models\Error;

class CreateErrorAction
{
    public function execute(array $data): Error
    {
        return Error::query()
            ->create($data);
    }
}
