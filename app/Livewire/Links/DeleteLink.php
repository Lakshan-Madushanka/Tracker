<?php

declare(strict_types=1);

namespace App\Livewire\Links;

use App\Actions\Link\DeleteLinkAction;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class DeleteLink extends Component
{
    public function delete(DeleteLinkAction $deleteLinkAction, string $linkId): void
    {
        $deleteLinkAction->execute($linkId);

        $this->dispatch('link-deleted');
    }

    public function render(): View|Factory|Application
    {
        return view('livewire.links.delete-link');
    }
}
