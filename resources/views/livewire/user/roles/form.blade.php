<div>
    <form wire:submit.prevent="saveRole">
        <div class="modal-content">
            <h5>
                Create role
            </h5>
            <div class="row">
                <div class="col s12">
                    <x-input name="name" label="Role name" />
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <x-cancel wire:click="closeForm" >
                Close
            </x-cancel>
            <x-save>
                Save
            </x-save>
        </div>
    </form>
</div>
