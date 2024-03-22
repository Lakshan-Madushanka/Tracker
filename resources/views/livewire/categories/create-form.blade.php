<div
    x-data="{show: false}"
    @create-category.window="if($wire.type === $event.detail.type){show=true}"
    @edit-category.window="if($wire.form.categoryId === $event.detail.id){show=true}"
    @category-created="show=false"
    @category-updated="show=false"
>
    <dialog class="modal" :open="show">
        <div class="modal-box w-full md:max-w-screen-md">
            <h3 class="font-bold text-lg mt-0">
                Create Category
            </h3>

            <div class="flex flex-col gap-4 mb-8">
                <div class="flex flex-col">
                    <label for="category_name" class="mb-1">Category</label>
                    <input wire:keydown.enter="save" wire:model="form.name" id="category_name" class="input input-bordered">
                    @error('form.name')
                    <div class="text-red-500">{{$message}}</div>
                    @enderror
                </div>

                <div class="flex justify-end gap-x-4">
                    <button @click="show=false" class="btn btn-warning">Cancel</button>
                    <button
                        wire:click="save"
                        class="btn btn-info flex justify-center items-center text-center gap-2"
                    >
                        <span>Save</span>
                        <span wire:loading class="loading loading-bars loading-xs"></span>
                    </button>
                </div>
            </div>
        </div>

            <form @click="show=false" method="dialog" class="modal-backdrop bg-black opacity-10">
                <button>close</button>
            </form>
    </dialog>
</div>
