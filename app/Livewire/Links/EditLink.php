<?php

declare(strict_types=1);

namespace App\Livewire\Links;

use App\Actions\Link\UpdateLinkAction;
use App\Models\Link;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class EditLink extends Component
{
    public LinkForm $form;

    public string $type = 'edit';

    public function mount(Link $link, Collection $categories): void
    {
        $this->form->categories = $categories;

        $this->form->setLink($link);
    }

    public function save(UpdateLinkAction $action): void
    {
        if ($this->form->update($action)) {
            $this->dispatch('link-updated');
        }

    }

    public function render()
    {
        return view('livewire.links.link-form');
    }
}
