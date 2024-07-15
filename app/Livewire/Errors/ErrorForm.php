<?php

declare(strict_types=1);

namespace App\Livewire\Errors;

use App\Actions\Error\CreateErrorAction;
use App\Actions\Error\UpdateErrorAction;
use App\Models\Error;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ErrorForm extends Form
{
    public Error $error;

    public string $errorId;

    public $categories;

    #[Validate(['string', 'required', 'exists:categories,id'])]
    public string $category_id = '';

    #[Validate(['string', 'required', 'min:3'])]
    public string $name = '';

    #[Validate(['string', 'nullable'])]
    public string $description = '';

    #[Validate(['string', 'nullable'])]
    public ?string $project_name;

    #[Validate(['url', 'nullable'])]
    public ?string $project_url;

    #[Validate(['string', 'min:3', 'nullable'])]
    public ?string $stack_trace = '';

    public function setCategories(Collection $categories): void
    {
        $this->categories = $categories;
    }

    public function setError(Error $error): void
    {
        $this->error = $error;

        $this->errorId = $error->getKey();
        $this->category_id = $error->category_id;
        $this->name = $error->name;
        $this->description = $error->description;
        $this->project_name = $error->project_name;
        $this->project_url = $error->project_url;
        $this->stack_trace = $error->stack_trace;
    }

    /**
     * @throws ValidationException
     */
    public function store(CreateErrorAction $createErrorAction): Error
    {
        $this->validate();

        $error = $createErrorAction->execute($this->except('categories', 'errorId', 'error'));

        $this->resetValidation();
        $this->reset('category_id', 'name', 'description', 'project_name', 'project_url', 'stack_trace');

        return $error;
    }

    public function edit(UpdateErrorAction $editErrorAction): bool
    {
        $this->validate();

        $error = $editErrorAction->execute($this->error, $this->except('categories', 'errorId', 'error'));

        $this->resetValidation();

        return $error;
    }
}
