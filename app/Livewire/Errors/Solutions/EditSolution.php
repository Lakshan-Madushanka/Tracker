<?php

declare(strict_types=1);

namespace App\Livewire\Errors\Solutions;

use App\Actions\Error\Solution\UpdateSolutionAction;
use App\Models\Error;
use App\Models\Solution;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class EditSolution extends Component
{
    public SolutionForm $form;

    public function mount(Error $error, ?Solution $solution): void
    {
        $this->form->setError($error);
        $this->form->setSolution($solution);
    }

    public function save(UpdateSolutionAction $updateSolutionAction): void
    {
        if ($this->form->update($updateSolutionAction)) {
            $this->dispatch('solution-updated');
        }

    }

    public function render(): View|Factory|Application
    {
        return view('livewire.errors.solutions.create-solution');
    }
}
