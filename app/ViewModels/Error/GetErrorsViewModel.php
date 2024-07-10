<?php

declare(strict_types=1);

namespace App\ViewModels\Error;

use App\DataObjects\Errors\ErrorFilter;
use App\Models\Category;
use App\Models\Error;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\ViewModels\ViewModel;

class GetErrorsViewModel extends ViewModel
{
    public function __construct(private readonly ErrorFilter $filter = new ErrorFilter()) {}

    /**
     * @return LengthAwarePaginator<Model>
     */
    public function errors(): LengthAwarePaginator
    {
        return Error::query()
            ->with([
                'category',
                'solutions' => fn (HasMany $query) => $query
                    ->orderBy('rank')
                    ->orderByDesc('updated_at'),
            ])
            ->when(
                $this->filter->name,
                fn (Builder $query) => $query
                    ->where(
                        fn (Builder $query) => $query
                            ->where('name', 'like', "%{$this->filter->name}%")
                            ->orWhere('project_name', 'like', "%{$this->filter->name}%")
                    )
            )
            ->when(
                $this->filter->category,
                fn (Builder $query) => $query
                    ->whereHas('category', fn (Builder $query) => $query->where('name', $this->filter->category))
            )
            ->latest()
            ->paginate();
    }

    /**
     * @return Collection<int, Category>
     */
    public function categories(): Collection
    {
        return Category::all(['name', 'id']);
    }
}
