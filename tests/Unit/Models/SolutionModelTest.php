<?php

declare(strict_types=1);

use App\Models\Solution;

it('has columns', function ($name): void {
    $solution = Solution::factory()->create();

    expect($solution)
        ->toBeInstanceOf(Solution::class)
        ->{$name}->toBe($solution->{$name});
})->with([
    'rank',
    'text',
]);

it('has fillable columns', function ($name): void {
    $columns = (new Solution())->getFillable();
    expect(in_array($name, $columns))->toBeTrue();
})->with([
    'rank',
    'text',
]);

it('has has belongs to relationship for error', function (): void {
    $solution = Solution::factory()
        ->for(App\Models\Error::factory(['name' => 'error']))
        ->create();

    $error = $solution->error;

    expect($error)
        ->toBeInstanceOf(App\Models\Error::class)
        ->name->toBe('error');
});
