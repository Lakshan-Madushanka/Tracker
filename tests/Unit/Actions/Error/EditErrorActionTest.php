<?php

declare(strict_types=1);

use App\Actions\Error\UpdateErrorAction;
use App\Models\Error;

use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;

it('can create a error', function (): void {
    $error = Error::factory()->create();

    $data = Error::factory()->make()->toArray();

    app(UpdateErrorAction::class)->execute($error, $data);

    assertDatabaseCount($error->getTable(), 1);
    assertDatabaseHas($error->getTable(), $data);
});
