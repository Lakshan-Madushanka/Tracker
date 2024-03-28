<?php

declare(strict_types=1);

namespace App\Livewire\Errors;

use App\Actions\Error\CreateErrorAction;
use App\Models\Category;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class CreateError extends Component
{
    public ErrorForm $form;

    public string $type = 'create';

    /**
     * @param  Collection<int, Category>  $categories
     */
    public function mount(Collection $categories): void
    {
        $this->form->categories = $categories;
    }

    /**
     * @throws ValidationException
     */
    public function save(CreateErrorAction $action): void
    {
        $this->form->store($action);

        $this->dispatch('error-created');
    }

    public function render(): View|Factory|Application
    {
        return view('livewire.errors.create-error');
    }
}
