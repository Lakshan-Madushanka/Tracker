<div
    x-data="{show: false, errorId: 0}"
    @delete-all-solutions.window="errorId=$event.detail.errorId; show=true"
    @@all-solutions-deleted="show=false"
>
    <dialog id="my_modal_3" class="modal" :open="show">
        <div class="modal-box">
            <h3 class="font-bold text-lg">Delete Confirmation</h3>
            <p class="py-1">Are you sure to delete this error? This can't be undone</p>
            <div class="flex justify-end gap-x-4">
                <button @click="show=false" class="btn btn-warning">Cancel</button>
                <button wire:click="deleteAll(errorId)" class="btn btn-info flex justify-center items-center text-center gap-2">
                    <span>Confirm</span>
                    <span wire:loading class="loading loading-bars loading-xs"></span>
                </button>
            </div>
        </div>
        <form @click="show=false" method="dialog" class="modal-backdrop">
            <button>close</button>
        </form>
    </dialog>
</div>

