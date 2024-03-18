<?php

declare(strict_types=1);

namespace App\Livewire\Links;

use App\Actions\Link\CreateLinkAction;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class CreateLink extends Component
{
    public LinkForm $form;

    public string $type = 'create';

    public function mount(Collection $categories): void
    {
        $this->form->categories = $categories;
    }

    public function save(CreateLinkAction $action): void
    {
        $this->form->store($action);

        $this->dispatch('link-created');
    }

    public function render()
    {
        return view('livewire.links.link-form');
    }
}
