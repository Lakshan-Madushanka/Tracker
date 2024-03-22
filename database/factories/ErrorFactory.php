<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Category;
use Carbon\Exceptions\BadFluentConstructorException;
use http\Exception\BadConversionException;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\UniqueConstraintViolationException;
use Exception;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Error>
 */
class ErrorFactory extends Factory
{
    private $i = 1;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $error = $this->getError($this->i);

        $this->i = $this->i + 1;

        return [
            'category_id' => Category::factory(),
            'name' => $error['name'],
            'description' => $this->faker->sentence(),
            'project_name' => $this->faker->words(random_int(2, 5), true),
            'project_url' => $this->faker->url(),
            'stack_trace' => $error['stack_trace'],
        ];
    }

    private function getError(int $iterator)
    {
        $errorNo = $iterator % 3;

        if ($errorNo === 0) {
            $errorNo = 3;
        }

        try {
            match($errorNo) {
                1 => $this->error1(),
                2 => $this->error2(),
                3 => $this->error3(),
            };
        } catch (Exception $e) {
            return [
                'name' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ];
        }
    }

    private function error1(): void
    {
        throw app(UniqueConstraintViolationException::class);
    }

    private function error2(): void
    {
        throw app(BadFluentConstructorException::class);

    }

    private function error3(): void
    {
        throw app(BadConversionException::class);
    }
}
