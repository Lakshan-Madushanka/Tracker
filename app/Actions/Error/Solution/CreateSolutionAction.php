<?php

declare(strict_types=1);

namespace App\Actions\Error\Solution;

use App\Models\Error;
use App\Models\Solution;
use Illuminate\Support\Arr;

class CreateSolutionAction extends UpsertSolutionAction
{
    public function execute(Error $error, array $data): Solution
    {
        $data['rank'] = $this->rank($error, Arr::get($data, 'rank'));

        return $error->solutions()->create($data);
    }
}
