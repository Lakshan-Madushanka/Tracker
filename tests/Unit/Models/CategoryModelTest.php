<?php

declare(strict_types=1);

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

it('has columns', function ($name): void {
    $category = Category::factory()->create();

    expect($category)
        ->toBeInstanceOf(Category::class)
        ->{$name}->toBe($category->{$name});
})->with([
    'name',
]);

it('has fillable columns', function ($name): void {
    $columns = (new Category())->getFillable();
    expect(in_array($name, $columns))->toBeTrue();
})->with([
    'name',
]);

it('has has many relationship for errors', function (): void {
    $category = Category::factory()
        ->has(App\Models\Error::factory(['name' => 'error']))
        ->create();

    $errors = $category->errors;

    expect($errors)
        ->toBeInstanceOf(Collection::class)
        ->toHaveCount(1)
        ->first()
        ->name->toBe('error');
});
