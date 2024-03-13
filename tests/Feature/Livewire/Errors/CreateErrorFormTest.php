<?php

declare(strict_types=1);

use App\Livewire\Errors\CreateError;
use Livewire\Livewire;

it('required category', function (): void {
    Livewire::test(CreateError::class)
        ->set('form.category_id', '')
        ->call('save')
        ->assertHasErrors(['form.category_id' => ['required']]);
});

it('should have a valid category', function (): void {
    Livewire::test(CreateError::class)
        ->set('form.category_id', 'invalid category')
        ->call('save')
        ->assertHasErrors(['form.category_id' => ['exists']]);
});

it('can validate error name', function (): void {
    Livewire::test(CreateError::class)
        ->set('form.name', '')
        ->call('save')
        ->assertHasErrors(['form.name' => ['required']])
        ->set('form.name', 'a')
        ->call('save')
        ->assertHasErrors(['form.name' => ['min']]);
});

it('can validate project url', function (): void {
    Livewire::test(CreateError::class)
        ->set('form.project_url', 'abc')
        ->call('save')
        ->assertHasErrors(['form.project_url' => ['url']]);
});

it('can validate stack trace', function (): void {
    Livewire::test(CreateError::class)
        ->set('form.stack_trace', 'ac')
        ->call('save')
        ->assertHasErrors(['form.stack_trace' => ['min:3']]);
});
