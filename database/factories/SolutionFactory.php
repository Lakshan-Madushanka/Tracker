<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Error;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Solution>
 */
class SolutionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'error_id' => Error::factory(),
            'rank' => random_int(1, 10),
            'text' => $this->faker->paragraphs(asText: true),
        ];
    }
}
