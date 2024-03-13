<?php

declare(strict_types=1);

namespace App\Actions\Error;

use App\Models\Error;

class UpdateErrorAction
{
    public function execute(Error $error, array $data): bool
    {
        return $error->fill($data)->save();
    }
}
