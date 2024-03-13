<?php

declare(strict_types=1);

namespace App\Livewire\Errors\Solutions;

use App\Actions\Error\Solution\CreateSolutionAction;
use App\Actions\Error\Solution\UpdateSolutionAction;
use App\Models\Error;
use App\Models\Solution;
use Livewire\Attributes\Validate;
use Livewire\Form;

class SolutionForm extends Form
{
    public Error $error;

    public ?Solution $solution;

    #[Validate('required|min:3')]
    public string $text = '';

    #[Validate('integer|nullable|min:1')]
    public ?int $rank;

    public function setError(Error $error): void
    {
        $this->error = $error;
    }

    public function setSolution(?Solution $solution): void
    {
        $this->solution = $solution;
        $this->text = $solution->text;
        $this->rank = $solution->rank;
    }

    public function store(CreateSolutionAction $createSolutionAction): void
    {
        $this->validate();

        $createSolutionAction->execute($this->error, $this->except('error', 'solution'));

        $this->reset(['text', 'rank']);
    }

    public function update(UpdateSolutionAction $updateSolutionAction): bool
    {
        $this->validate();

        return $updateSolutionAction->execute($this->error, $this->solution, $this->only(['text', 'rank']));
    }

}
