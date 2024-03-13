<?php

declare(strict_types=1);

use App\Actions\Error\DeleteErrorAction;
use App\Models\Error;

use function Pest\Laravel\assertDatabaseCount;

it('can create a error', function (): void {
    $error = Error::factory()->create();

    app(DeleteErrorAction::class)->execute($error->getKey());

    assertDatabaseCount($error->getTable(), 0);
});
