<?php

declare(strict_types=1);

namespace App\Actions\Error\Solution;

use App\Models\Error;
use App\Models\Solution;
use Illuminate\Support\Arr;

class UpdateSolutionAction extends UpsertSolutionAction
{
    public function execute(Error $error, Solution $solution, array $data): bool
    {
        //        if (! $rank = Arr::get($data, 'rank')) {
        //            $rank = $error->solutions()->orderByDesc('rank')->first(['rank'])?->rank;
        //            $rank = is_null($rank) ? 1 : $rank + 1;
        //            $data['rank'] = $rank;
        //        }

        $solution->rank = $this->rank($error, $data['rank']);
        $solution->text = $data['text'];

        return $solution->save();
    }
}
