<div
    x-data="{show: false, solutionId: 0}"
    @create-error.window="if($wire.type === 'create'){show=true}"
    @edit-error.window="if($wire.form.errorId === $event.detail.id){show=true}"
    @@error-created="show=false"
    @@error-edited="show=false"
>
    <dialog class="modal" :open="show">
        <div class="modal-box w-full md:max-w-screen-md">
            <h3 class="font-bold text-lg mt-0">
                Create Error
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
                    <div class="text-red-500">{{$message}}</div>@enderror
                </div>
                <div class="flex flex-col">
                    <label for="error_name">Content</label>
                    <textarea
                        wire:model="form.name"
                        id="error_name"
                        class="textarea textarea-bordered"
                        placeholder="error"
                    >
                    </textarea>
                    @error('form.name')
                    <div class="text-red-500">{{$message}}</div>@enderror
                </div>
                <div class="flex flex-col">
                    <label for="error_project_name">Project Name</label>
                    <input
                        wire:model="form.project_name"
                        id="error_project_name"
                        class="input input-bordered"
                        placeholder="project name"
                    />
                    @error('form.project_name')
                    <div class="text-red-500">{{$message}}</div>@enderror
                </div>
                <div class="flex flex-col">
                    <label for="error_project_url">Project URL</label>
                    <input
                        wire:model="form.project_url"
                        id="error_project_url"
                        class="input input-bordered"
                        type="url"
                        placeholder="project url"
                    />
                    @error('form.project_url')
                    <div class="text-red-500">{{$message}}</div>@enderror
                </div>
                <div class="flex flex-col">
                    <label for="error_stacktrace">Stack Trace</label>
                    <textarea
                        wire:model="form.stack_trace"
                        id="error_stacktrace"
                        class="textarea textarea-bordered"
                        placeholder="stack trace"
                    >
                    </textarea>
                    @error('form.stack_trace')
                    <div class="text-red-500">{{$message}}</div>@enderror
                </div>
            </div>

            <div class="flex justify-end gap-x-4">
                <button @click="show=false" class="btn btn-warning">Cancel</button>
                <button
                    wire:click="save"
                    class="btn btn-info flex justify-center items-center text-center gap-2"
                >
                    <span>Confirm</span>
                    <span wire:loading class="loading loading-bars loading-xs"></span>
                </button>
            </div>
        </div>
        <form @click="show=false" method="dialog" class="modal-backdrop bg-black opacity-10">
            <button>close</button>
        </form>
    </dialog>
</div>
