@php use Illuminate\Support\Str; @endphp
<div class="bg-white">
    <livewire:categories.create-category  @category-created="$refresh"/>
    <livewire:categories.delete-category  @category-deleted="$refresh"/>
    <header class="flex justify-between p-2">
        <h1 class="m-0">Categories</h1>
        <button @click="$dispatch('create-category', {type:'create'})" class="btn btn-primary">Create</button>
    </header>
    <div class="overflow-x-auto text-nowrap">
        <table class="table border-t">
            <!-- head -->
            <thead>
            <tr>
                <th></th>
                <th>Name</th>
                <th>Created at</th>
                <th>Updated at</th>
            </tr>
            </thead>
            <tbody>
            @forelse($categories as $category)
                <tr>
                    <th>{{$loop->iteration}}</th>
                    <td>{{$category->name}}</td>
                    <td>{{$category->created_at->diffForHumans()}}</td>
                    <td>{{$category->updated_at->diffForHumans()}}</td>
                    <td>
                        <span @click="$dispatch('edit-category', {type: 'edit', id: '{{$category->id}}'})" class="link link-primary">Edit</span>
                        <livewire:categories.edit-category wire:key="edit-category{{$category->getKey()}}" :$category @category-updated="$refresh"/>
                    </td>
                    <td>
                        <span @click="$dispatch('delete-category', {type: 'edit', id: '{{$category->id}}'})" class="link link-primary">Delete</span>
                    </td>
                </tr>
            @empty
                <h2 class="text-yellow-400">No category found</h2>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
