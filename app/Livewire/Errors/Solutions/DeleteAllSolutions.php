<?php

declare(strict_types=1);

namespace App\Livewire\Errors\Solutions;

use App\Actions\Error\Solution\DeleteAllSolutionsAction;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class DeleteAllSolutions extends Component
{
    public function deleteAll(DeleteAllSolutionsAction $deleteAllSolutionsAction, string $errorId): void
    {
        $deleteAllSolutionsAction->execute($errorId);

        $this->dispatch('remove-solution-list', errorId: $errorId);

        $this->dispatch('all-solutions-deleted');
    }

    public function render(): View|Factory|Application
    {
        return view('livewire.errors.solutions.delete-all-solutions');
    }
}
