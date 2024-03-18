<?php

declare(strict_types=1);

namespace App\ViewModels\Link;

use App\DataObjects\Errors\LinkFilter;
use App\Models\Category;
use App\Models\Link;
use App\ViewModels\Category\GetCategoriesViewModel;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Spatie\ViewModels\ViewModel;

class GetLinksViewModel extends ViewModel
{
    public function __construct(private readonly LinkFilter $filter = new LinkFilter())
    {
        //
    }

    /**
     * @return LengthAwarePaginator<Link>
     */
    public function links(): LengthAwarePaginator
    {
        return Link::query()
            ->with('category')
            ->when(
                $this->filter->search,
                fn(Builder $query) => $query
                    ->where(
                        fn(Builder $query) => $query
                            ->where('url', 'like', "%{$this->filter->search}%")
                            ->orWhere('description', 'like', "%{$this->filter->search}%")
                    )
            )
            ->when(
                $this->filter->category,
                fn(Builder $query) => $query
                    ->whereHas('category', fn(Builder $query) => $query->where('name', $this->filter->category))
            )
            ->orderByDesc('id')
            ->paginate();
    }

    /**
     * @return Collection<int, Category>
     */
    public function categories(): Collection
    {
        return app(GetCategoriesViewModel::class)->categories();
    }
}
