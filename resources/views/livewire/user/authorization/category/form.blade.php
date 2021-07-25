<div x-data x-init="M.updateTextFields();">
    <form wire:submit.prevent="saveCategory">
        <div class="modal-content">
            <h5>
                Add category
            </h5>
            <div class="row">
                <div class="col s12">
                    <div wire:ignore class="input-field">
                        <input x-ref="input1" type="text" wire:model="name" id="name">
                        <label for="name">Category Name</label>
                    </div>
                    @error('name')
                        <blockquote x-data x- init="$('#name').addClass('invalid')">{{$message}}</blockquote>
                    @enderror
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button wire:click="closeForm" wire:loading.attr="disabled" type="button" class="btn waves-effect transparent red-text btn-small">
                Close <i class="material-icons right red-text">close</i>
            </button>
            <button type="submit" class="btn waves-effect transparent green-text btn-small">
                {{$model_id==0?'Save':'Update'}} <i class="material-icons right green-text">save</i>
            </button>
        </div>
    </form>
</div>
