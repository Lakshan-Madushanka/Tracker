<?php

declare(strict_types=1);

use App\Livewire\Categories\CategoryList;
use Livewire\Livewire;

it('renders successfully', function (): void {
    Livewire::test(CategoryList::class)
        ->assertStatus(200);
});
