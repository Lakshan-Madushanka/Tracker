@php
    use Illuminate\Support\Str;
    $id = Str::random();
@endphp

<form  class="flex flex-col space-y-2">
    <div class="bg-white">
        <input x-ref="trixEditor" id="{{$id}}" type="hidden" name="content" value="{{$form->text}}">
        <trix-editor
            @trix-change.self="$wire.form.text = $refs.trixEditor.getAttribute('value')"
            input="{{$id}}"
            placeholder="Solution"
        >
        </trix-editor>
    </div>
    <div class="text-red-500">@error('form.text') {{$message}} @enderror</div>

    <input wire:model="form.rank" type="number" min="1"  placeholder="Rank" class="input input-bordered w-full max-w-xs" />
    <div class="text-red-500">@error('form.rank') {{$message}} @enderror</div>

    <button wire:dirty.remove type="button" class="btn btn-active btn-xs btn-disabled self-start">Create</button>
    <div class="flex space-x-2">
        <button wire:dirty wire:click="save" type="button" class="btn btn-active btn-xs self-start">
            <span>Save</span>
        </button>
        <span wire:loading class="loading loading-spinner loading-xs"></span>
    </div>
</form>
