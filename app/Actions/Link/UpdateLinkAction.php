<?php

declare(strict_types=1);

namespace App\Actions\Link;

use App\Models\Link;

class UpdateLinkAction
{
    public function execute(Link $link, array $data): bool
    {
        return $link->fill($data)->save();
    }
}
