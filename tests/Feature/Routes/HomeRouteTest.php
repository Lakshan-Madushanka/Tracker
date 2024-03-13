<?php

declare(strict_types=1);

use function Pest\Laravel\get;

it('has a index route', function (): void {
    get(route('home'))
        ->assertOk();
});
