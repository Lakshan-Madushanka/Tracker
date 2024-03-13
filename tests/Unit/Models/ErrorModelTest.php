<?php

declare(strict_types=1);

use App\Models\Category;
use App\Models\Error;
use App\Models\Solution;
use Illuminate\Database\Eloquent\Collection;

it('has columns', function ($name): void {
    $error = Error::factory()->create();

    expect($error)
        ->toBeInstanceOf(Error::class)
        ->{$name}->toBe($error->{$name});
})->with([
    'name',
    'project_name',
    'project_url',
    'stack_trace',
]);

it('has fillable columns', function ($name): void {
    $columns = (new Error())->getFillable();
    expect(in_array($name, $columns))->toBeTrue();
})->with([
    'name',
    'project_name',
    'project_url',
    'stack_trace',
]);

it('has has belongs to relationship for category', function (): void {
    $error = Error::factory()
        ->for(Category::factory())
        ->create();

    $category = $error->category;

    expect($category)
        ->toBeInstanceOf(Category::class);
});

it('has many relationship to solution', function (): void {
    $error = Error::factory()
        ->has(Solution::factory()->count(5))
        ->create();

    $solutions = $error->solutions;

    expect($solutions)
        ->toBeInstanceOf(Collection::class)
        ->toHaveCount(5)
        ->first()
        ->toBeInstanceOf(Solution::class);
});
