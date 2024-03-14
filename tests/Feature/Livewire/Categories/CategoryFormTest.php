<?php

declare(strict_types=1);

use App\Livewire\Categories\CreateCategory;
use App\Models\Category;
use Livewire\Livewire;

it('required name', function (): void {
    Livewire::test(CreateCategory::class)
        ->set('form.name', '')
        ->call('save')
        ->assertHasErrors(['form.name' => ['required']])
        ->assertStatus(200);
});

it('required unique name', function (): void {
    $category = Category::factory()->create();

    Livewire::test(CreateCategory::class)
        ->set('form.name', $category->name)
        ->call('save')
        ->assertHasErrors(['form.name' => ['unique']])
        ->assertStatus(200);
});
