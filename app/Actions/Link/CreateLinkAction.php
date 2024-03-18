<?php

declare(strict_types=1);

namespace App\Actions\Link;

use App\Models\Link;

class CreateLinkAction
{
    public function execute(array $data): Link
    {
        return Link::query()
            ->create($data);
    }
}
