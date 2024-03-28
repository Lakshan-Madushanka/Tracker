<?php

declare(strict_types=1);

use App\DataObjects\Errors\ErrorFilter;
use App\Models\Category;
use App\Models\Error as Error;
use App\Models\Solution;
use App\ViewModels\Error\GetErrorsViewModel;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Support\Facades\DB;
use Pest\Expectation;

it('can obtain paginated errors with categories and solutions ordered by latest', function (): void {
    Error::factory()->count(20)->has(Solution::factory())->create();
    $lastError = Error::factory()->has(Solution::factory())->create(['created_at' => now()->addHour()]);

    $errorViewModel = new GetErrorsViewModel();
    $errors = $errorViewModel->errors();

    expect($errors)->first()->getKey()->toBe($lastError->getKey())
        ->and($errors->perPage())->toBe($lastError->getPerPage())
        ->and($errors)
        ->toHaveCount($lastError->getPerPage())
        ->each(function (Expectation $error): void {
            $error->toBeInstanceOf(Error::class);
            $error->category->toBeInstanceOf(Category::class);
            $error->solutions
                ->toBeInstanceOf(Collection::class)
                ->toHaveCount(1)
                ->each(function (Expectation $solution): void {
                    $solution->toBeInstanceOf(Solution::class);
                });
        });
});

it('can obtain error solutions order by its rank', function (): void {
    $error = Error::factory()
        ->create();

    $solution1 = Solution::factory()->create(['rank' => 3]);
    $solution3 = Solution::factory()->create(['rank' => 1]);
    $solution2 = Solution::factory()->create(['rank' => 2]);

    $error->solutions()->saveMany([$solution1, $solution2, $solution3]);

    DB::enableQueryLog();
    $errorViewModel = new GetErrorsViewModel();
    $errors = $errorViewModel->errors();

    $solutionRanks = $errors->first()->solutions->pluck('rank')->all();

    expect($solutionRanks)->toBe([1, 2, 3]);
});

it('can obtain list of categories', function (): void {
    $c = Category::factory()->count(5)->create();

    $errorViewModel = new GetErrorsViewModel();
    $categories = $errorViewModel->categories();

    expect($categories)
        ->toBeInstanceOf(Collection::class)
        ->toHaveCount(5)
        ->each
        ->toBeInstanceOf(Category::class);
});

it('can filter errors by name', function (): void {
    Error::factory()
        ->count(2)
        ->state(new Sequence(
            ['name' => 'error1'],
            ['name' => 'error2'],
        ))
        ->create();

    $vm = new GetErrorsViewModel(new ErrorFilter(name: '1'));

    $errors = $vm->errors();

    expect($errors)
        ->toHaveCount(1)
        ->first()
        ->toBeInstanceOf(Error::class)
        ->first()
        ->name->toBe('error1');
});

it('can filter errors by project_name', function (): void {
    Error::factory()
        ->count(2)
        ->state(new Sequence(
            ['project_name' => 'project1'],
            ['project_name' => 'project2'],
        ))
        ->create();

    $vm = new GetErrorsViewModel(new ErrorFilter(name: '1'));

    $errors = $vm->errors();

    expect($errors)
        ->toHaveCount(1)
        ->first()
        ->toBeInstanceOf(Error::class)
        ->first()
        ->project_name->toBe('project1');
});

it('can filter errors by category name', function (): void {
    $category1 = Category::factory()->create(['name' => 'category1']);
    $category2 = Category::factory()->create(['name' => 'category2']);

    $error1 = Error::factory()->create();
    $error2 = Error::factory()->create();

    $category1->errors()->save($error1);
    $category2->errors()->save($error2);

    $vm = new GetErrorsViewModel(new ErrorFilter(category: 'category1'));

    $errors = $vm->errors();

    expect($errors)
        ->toHaveCount(1)
        ->first()
        ->toBeInstanceOf(Error::class)
        ->first()
        ->category->toBeInstanceOf(Category::class)
        ->first()
        ->category->name->toBe('category1');
});

it('can filter errors by category name and error name', function (): void {
    $category1 = Category::factory()->create(['name' => 'category1']);
    $category2 = Category::factory()->create(['name' => 'category2']);

    $error1 = Error::factory()->create(['name' => 'error1']);
    $error2 = Error::factory()->create(['name' => 'error2']);

    $category1->errors()->save($error1);
    $category2->errors()->save($error2);

    $vm = new GetErrorsViewModel(new ErrorFilter(category: 'category1', name: '1'));

    $errors = $vm->errors();

    expect($errors)
        ->toHaveCount(1)
        ->and($errors[0])
        ->toBeInstanceOf(Error::class)
        ->name->toBe('error1')
        ->category->toBeInstanceOf(Category::class)
        ->category->name->toBe('category1');
});

it('can filter errors by category name and project name', function (): void {
    $category1 = Category::factory()->create(['name' => 'category1']);
    $category2 = Category::factory()->create(['name' => 'category2']);

    $error1 = Error::factory()->create(['project_name' => 'project1']);
    $error2 = Error::factory()->create(['project_name' => 'project2']);

    $category1->errors()->save($error1);
    $category2->errors()->save($error2);

    $vm = new GetErrorsViewModel(new ErrorFilter(category: 'category1', name: '1'));

    $errors = $vm->errors();

    expect($errors)
        ->toHaveCount(1)
        ->and($errors[0])
        ->toBeInstanceOf(Error::class)
        ->project_name->toBe('project1')
        ->category->toBeInstanceOf(Category::class)
        ->category->name->toBe('category1');
});
