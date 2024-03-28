<?php

declare(strict_types=1);

namespace App\Livewire\Errors;

use App\Actions\Error\UpdateErrorAction;
use App\Models\Category;
use App\Models\Error;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class EditError extends Component
{
    public ErrorForm $form;

    public string $type = 'edit';

    /**
     * @param  Collection<int, Category>  $categories
     */
    public function mount(Collection $categories, Error $error): void
    {
        $this->form->setCategories($categories);
        $this->form->setError($error);
    }

    public function save(UpdateErrorAction $editErrorAction): void
    {
        if ($this->form->edit($editErrorAction)) {
            $this->dispatch('error-edited');
        }
    }

    public function render(): View|Factory|Application
    {
        return view('livewire.errors.create-error');
    }
}
