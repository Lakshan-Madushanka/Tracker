<?php

declare(strict_types=1);

use function Pest\Laravel\get;

it('has a index route', function (): void {
    get(route('home'))
        ->assertOk();
});

it('has a category route', function (): void {
    get(route('categories'))
        ->assertOk();
});
