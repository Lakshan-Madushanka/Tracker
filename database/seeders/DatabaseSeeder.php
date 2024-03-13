<?php

declare(strict_types=1);

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Error;
use App\Models\Solution;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Category::factory()
            ->has(
                Error::factory()
                    ->has(
                        Solution::factory()
                            ->count(5)
                    )
                    ->count(20)
            )
            ->count(5)
            ->create();
    }
}
