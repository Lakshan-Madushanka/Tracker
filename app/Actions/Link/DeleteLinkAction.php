<?php

declare(strict_types=1);

namespace App\Actions\Link;

use App\Models\Link;

class DeleteLinkAction
{
    public function execute(string $linkId): bool
    {
        return Link::query()->find($linkId)->delete();
    }
}
