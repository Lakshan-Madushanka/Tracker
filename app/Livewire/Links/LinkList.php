<?php

declare(strict_types=1);

namespace App\Livewire\Links;

use App\DataObjects\Errors\LinkFilter;
use App\ViewModels\Link\GetLinksViewModel;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Url;
use Livewire\Component;

class LinkList extends Component
{
    #[Url]
    public string $search = '';

    #[Url]
    public string $category = '';

    public function render(): View|Factory|Application
    {
        $viewModel = app(GetLinksViewModel::class, ['filter' => new LinkFilter($this->search, $this->category)]);

        return view('livewire.links.link-list', $viewModel);
    }
}
