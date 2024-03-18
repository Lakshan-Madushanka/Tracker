@php use Illuminate\Support\Str; @endphp
<div class="bg-white">
    <livewire:links.create-link :$categories @link-created="$refresh"/>
    <livewire:links.delete-link @link-deleted="$refresh"/>

    <header class="flex justify-between p-2">
        <h1 class="m-0">Links</h1>
        <button @click="$dispatch('create-link', {type:'create'})" class="btn btn-primary">Create</button>
    </header>

    <div class="flex flex-col p-2 sm:flex-row mt-4 w-full gap-y-2 gap-x-8">
        <x-inputs.search class="sm:w-[80%]" inputAttr="wire:model.live=search"/>
        <select wire:model.live="category" class="select select-bordered grow sm:max-w-xs">
            <option value="" selected>All</option>
            @foreach($categories as $category)
                <option value="{{$category->name}}">{{$category->name}}</option>
            @endforeach
        </select>
    </div>

    <div class="flex justify-center h-4 mt-4">
        <span class="loading loading-bars loading-md" wire:loading/>
    </div>

    <div class="overflow-x-auto text-nowrap">
        <table class="table border-t">
            <!-- head -->
            <thead>
            <tr>
                <th></th>
                <th>URL</th>
                <th>Category</th>
                <th>Description</th>
                <th>Created at</th>
                <th>Updated at</th>
            </tr>
            </thead>
            <tbody>
            @forelse($links as $link)
                <tr wire:key="{{$link->getKey()}}">
                    <th>{{$loop->iteration}}</th>
                    <td><a class="link link-primary" href="{{$link->url}}" target="_blank">{{$link->url}}</a></td>
                    <td><span class="badge badge-accent">{{$link->category->name}}</span></td>
                    <td>{{Str::limit(Str::overwriteEmpty($link->description))}}</td>
                    <td>{{$link->created_at->diffForHumans()}}</td>
                    <td>{{$link->updated_at->diffForHumans()}}</td>
                    <td>
                        <span @click="$dispatch('edit-link', {type: 'edit', id: '{{$link->id}}'})" class="link link-primary">Edit</span>
                        <livewire:links.edit-link  wire:key="edit-link-{{$link->getKey()}}" :$link :$categories @link-updated="$refresh"/>
                    </td>
                    <td>
                        <span @click="$dispatch('delete-link', {id: '{{$link->id}}'})" class="link link-primary">Delete</span>
                    </td>
                </tr>
            @empty
                <h2 class="text-yellow-400 text-center mt-0">No link found</h2>
            @endforelse
            </tbody>
        </table>
    </div>
    <div class="px-2">
        {{$links->links()}}
    </div>
</div>
