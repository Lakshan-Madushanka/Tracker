<?php

declare(strict_types=1);

namespace App\Livewire\Solutions;

use App\Actions\Solution\DeleteSolutionAction;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class DeleteSolution extends Component
{
    public function delete(string $solutionId, DeleteSolutionAction $deleteSolutionAction): void
    {
        $deleteSolutionAction->execute($solutionId);

        $this->dispatch('solution-deleted');
    }

    public function render(): View|Factory|Application
    {
        return view('livewire.solutions.delete-solution');
    }
}
