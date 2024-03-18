<?php

declare(strict_types=1);

namespace App\Livewire\Links;

use App\Actions\Link\CreateLinkAction;
use App\Actions\Link\UpdateLinkAction;
use App\Models\Link;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class LinkForm extends Form
{
    public string $category_id;

    public string $url;

    public string $description;

    public $categories;

    public Link $link;

    public string $linkId = '';

    public function rules(): array
    {
        return [
            'category_id' => ['string', 'required', 'exists:categories,id'],
            'url' => [
                'required',
                'url',
                Rule::unique('links')->ignore($this->linkId),
            ],
            'description' => ['string', 'nullable'],
        ];
    }

    public function setLink(Link $link): void
    {
        $this->link = $link;
        $this->linkId = $link->getkey();

        $this->url = $link->url;
        $this->description = $link->description;
        $this->category_id = $link->category_id;
    }

    public function store(CreateLinkAction $createLinkAction): void
    {
        $this->validate();

        $createLinkAction->execute($this->getData());
    }

    public function update(UpdateLinkAction $updateLinkAction): bool
    {
        $this->validate();

        return $updateLinkAction->execute($this->link, $this->getData());
    }

    private function getData(): array
    {
        return $this->except('categories', 'link', 'linkId');
    }
}
