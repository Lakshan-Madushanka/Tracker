<form class="flex flex-col space-y-2">
    <textarea wire:model="form.text" placeholder="Solution" class="textarea textarea-bordered textarea-lg w-full min-h-64" autofocus></textarea>
    <div class="text-red-500">@error('form.text') {{$message}} @enderror</div>
    <input wire:model="form.rank" type="number" min="1"  placeholder="Type here" class="input input-bordered w-full max-w-xs" />
    <div class="text-red-500">@error('form.rank') {{$message}} @enderror</div>

    <button wire:dirty.remove type="button" class="btn btn-active btn-xs btn-disabled self-start">Create</button>
    <div class="flex space-x-2">
        <button wire:dirty wire:click="save" type="button" class="btn btn-active btn-xs self-start">
            <span>Save</span>
        </button>
        <span wire:loading class="loading loading-spinner loading-xs"></span>
    </div>
</form>
