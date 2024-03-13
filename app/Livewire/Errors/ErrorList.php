<?php

declare(strict_types=1);

namespace App\Livewire\Errors;

use App\DataObjects\Errors\Filters;
use App\ViewModels\Error\GetErrorsViewModel;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class ErrorList extends Component
{
    use WithPagination;

    #[Url]
    public string $search = '';

    #[Url]
    public string $category = '';

    public function render(): View|Factory|Application
    {
        $filters = new Filters(name: $this->search, category: $this->category);

        return view('livewire.errors.error-list', new GetErrorsViewModel($filters));
    }
}
