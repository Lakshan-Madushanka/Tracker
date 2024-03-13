<?php

declare(strict_types=1);

use App\Actions\Error\CreateErrorAction;
use App\Models\Error;

use function Pest\Laravel\assertDatabaseHas;

it('can create a error', function (): void {
    $data = Error::factory()->make()->toArray();

    $action = app(CreateErrorAction::class)->execute($data);

    assertDatabaseHas((new Error())->getTable(), $data);

});
