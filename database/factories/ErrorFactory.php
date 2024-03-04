<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Error>
 */
class ErrorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category_id' => Category::factory(),
            'name' => $this->faker->sentence(),
            'project_name' => $this->faker->words(random_int(2, 5), true),
            'project_url' => $this->faker->url(),
            'stack_trace' => $this->faker->sentences(random_int(15, 15), true),
        ];
    }
}
