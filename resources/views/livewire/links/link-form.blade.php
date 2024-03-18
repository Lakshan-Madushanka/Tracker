<div
    x-data="{show: false}"
    @create-link.window="if($wire.type === $event.detail.type){show=true}"
    @edit-link.window="if($wire.form.linkId === $event.detail.id){show=true}"
    @link-created="show=false"
    @link-updated="show=false"
>
    <dialog class="modal" :open="show">
        <div class="modal-box w-full md:max-w-screen-md">
            <h3 class="font-bold text-lg mt-0">
                Create Link
            </h3>

            <div class="flex flex-col gap-4 mb-8">
                <div class="flex flex-col">
                    <label for="error_category" class="mb-1">Category</label>
                    <select
                        wire:model="form.category_id"
                        id="error_category"
                        class="select select-bordered w-full max-w-xs"
                    >
                        <option value=""></option>
                        @foreach($form->categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                    @error('form.category_id')
                    <div class="text-red-500">{{$message}}</div>
                    @enderror
                </div>

                <div class="flex flex-col">
                    <label for="link_url">URL</label>
                    <textarea
                        wire:model="form.url"
                        id="link_url"
                        class="textarea textarea-bordered"
                        type="url"
                        placeholder="url"
                    >
                    </textarea>
                    @error('form.url')
                    <div class="text-red-500">{{$message}}</div>
                    @enderror
                </div>
                <div class="flex flex-col">
                    <label for="link_description">Description</label>
                    <textarea
                        wire:model="form.description"
                        id="link_description"
                        class="textarea textarea-bordered"
                        placeholder="description"
                    >
                    </textarea>
                    @error('form.description')
                    <div class="text-red-500">{{$message}}</div>@enderror
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
