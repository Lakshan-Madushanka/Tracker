<?php

declare(strict_types=1);

use App\Livewire\Errors\Solutions\CreateSolution;
use Livewire\Livewire;

it('renders successfully', function (): void {
    Livewire::test(CreateSolution::class)
        ->assertStatus(200);
});

it('can validate test', function (): void {
    Livewire::test(CreateSolution::class)
        ->call('save')
        ->assertHasErrors(['form.text' => ['required']])
        ->set('form.text', 'a')
        ->set('form.rank', 0)
        ->call('save')
        ->assertHasErrors(['form.rank' => ['min:1']])
        ->assertHasErrors(['form.text' => ['min:3']]);
});

it('show validation errors', function (): void {
    Livewire::test(CreateSolution::class)
        ->call('save')
        ->assertSeeText('The text field is required.')
        ->set('form.text', 'a')
        ->set('form.rank', 0)
        ->call('save')
        ->assertSeeText('The rank field must be at least 1.')
        ->assertSeeText('The text field must be at least 3 characters.');
});
