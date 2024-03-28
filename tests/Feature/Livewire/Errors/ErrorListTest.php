<?php

declare(strict_types=1);

use App\Livewire\Errors\ErrorList;
use App\Models\Category;
use App\Models\Error as Error;
use App\Models\Solution;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Livewire;

it('renders successfully', function (): void {
    Livewire::test(ErrorList::class)
        ->assertStatus(200);
});

it('receives paginated data', function (): void {
    Error::factory()
        ->count(20)
        ->create();

    Livewire::test(ErrorList::class)
        ->assertViewHas('errors', function (LengthAwarePaginator $errors) {
            $error = new Error();

            return $errors->count() == $error->getPerPage() &&
                $errors->count() === $errors->perPage();
        });
});

it('shows list of errors', function (): void {
    Error::factory()
        ->count(3)
        ->state(new Sequence(
            ['name' => 'error1'],
            ['name' => 'error2'],
            ['name' => 'error3'],
        ))
        ->create();

    Livewire::test(ErrorList::class)
        ->assertSeeText('error1')
        ->assertSeeText('error2')
        ->assertSeeText('error3');
});

it('shows list of errors with solutions', function (): void {
    Error::factory()
        ->has(
            Solution::factory()
                ->state(new Sequence(
                    ['text' => 'solution1', 'rank' => 2],
                    ['text' => 'solution2', 'rank' => 1],
                ))
                ->count(2)
        )
        ->create(['name' => 'error1']);

    Livewire::test(ErrorList::class)
        ->assertSeeText('error1')
        ->assertSeeTextInOrder(['solution2', 'solution1']);

});

it('can search errors', function (): void {
    Error::factory()
        ->count(3)
        ->state(new Sequence(
            ['name' => 'error1', 'project_name' => 'project5'],
            ['name' => 'error2', 'project_name' => 'project4'],
            ['name' => 'error3', 'project_name' => 'project6'],
        ))
        ->create();

    Livewire::test(ErrorList::class)
        ->set('search', 1)
        ->assertSeeText('error1')
        ->assertDontSeeText('error2')
        ->assertDontSeeText('error3')
        ->set('search', 5)
        ->assertSeeText('error1')
        ->assertDontSeeText('error2')
        ->assertDontSeeText('error3');
});

it('has dropdown with all filters', function (): void {
    Category::factory()->count(5)->create();

    $cNames = Category::all()->pluck('name')->flatten()->all();

    foreach ($cNames as $name) {
        Livewire::test(ErrorList::class)
            ->assertSeeText($name);
    }
});

it('can filter errors by category', function (): void {
    $category1 = Category::factory()->create(['name' => 'cat1']);
    $category2 = Category::factory()->create(['name' => 'cat2']);

    $error1 = Error::factory()->create(['name' => 'error1']);
    $error2 = Error::factory()->create(['name' => 'error12']);

    $category1->errors()->save($error1);
    $category2->errors()->save($error2);

    Livewire::test(ErrorList::class)
        ->set('category', 'cat1')
        ->assertSeeText('error1')
        ->assertDontSeeText('error2')
        ->set('search', 'error')
        ->assertSeeText('error1')
        ->assertDontSeeText('error2');
});
