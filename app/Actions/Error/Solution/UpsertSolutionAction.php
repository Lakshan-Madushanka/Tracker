<?php

declare(strict_types=1);

namespace App\Actions\Error\Solution;

use App\Models\Error;

class UpsertSolutionAction
{
    public function rank(Error $error, ?int $rank): int
    {
        if ( ! $rank) {
            $rank = $error->solutions()->orderByDesc('rank')->first(['rank'])?->rank;
            $rank = is_null($rank) ? 1 : $rank + 1;
        }
        return $rank;
    }
}
