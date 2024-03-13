<?php

declare(strict_types=1);

namespace App\Livewire\Errors\Solutions;

use App\Actions\Error\Solution\CreateSolutionAction;
use App\Models\Error;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class CreateSolution extends Component
{
    public SolutionForm $form;

    public function mount(Error $error): void
    {
        $this->form->setError($error);
    }

    public function save(CreateSolutionAction $createSolutionAction): void
    {
        $this->form->store($createSolutionAction);

        $this->dispatch('solution-created');
    }

    public function render(): View|Factory|Application
    {
        return view('livewire.errors.solutions.create-solution');
    }
}
