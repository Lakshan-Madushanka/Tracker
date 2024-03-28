<?php

declare(strict_types=1);

namespace App\DataObjects\Errors;

use Illuminate\Contracts\Support\Arrayable;

class ErrorFilter implements Arrayable
{
    public function __construct(
        public readonly string $name = '',
        public readonly string $category = '',
    ) {
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }

    public function empty(): bool
    {
        return count(array_filter($this->toArray())) > 0;
    }
}
