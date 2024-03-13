<?php

declare(strict_types=1);

namespace App\Livewire\Errors;

use App\Actions\Error\DeleteErrorAction;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class DeleteError extends Component
{
    public function delete(DeleteErrorAction $deleteErrorAction, string $errorId): void
    {
        if ($deleteErrorAction->execute($errorId)) {
            $this->dispatch('error-deleted');
        }
    }

    public function render(): View|Factory|Application
    {
        return view('livewire.errors.delete-error');
    }
}
