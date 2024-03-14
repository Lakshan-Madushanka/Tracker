<?php

declare(strict_types=1);

use App\Models\Category;
use App\ViewModels\Category\GetCategoriesViewModel;
use Illuminate\Database\Eloquent\Factories\Sequence;

it('return category list in alphabetic order', function (): void {
    Category::factory()
        ->state(new Sequence(
            ['name' => 'a'],
            ['name' => 'b'],
            ['name' => 'c'],
            ['name' => 'd'],
            ['name' => 'e'],
        ))
        ->count(5)
        ->create();

    $categoryViewModel = app(GetCategoriesViewModel::class);
    $categories = $categoryViewModel->categories();

    expect($categories->pluck('name')->toArray())->toBe(['a', 'b', 'c', 'd', 'e']);
});
