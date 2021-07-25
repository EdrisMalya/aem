<div x-data x-init="M.updateTextFields();">
    <form wire:submit.prevent="saveRule">
        <div class="modal-content">
            <h5>
                Add category
            </h5>
            <div class="row">
                <div  class="col s12">
                    <div wire:ignore class="input-field">
                        <input type="text" wire:model="name" id="name">
                        <label for="name">Role Name</label>
                    </div>
                    @error('name')
                    <blockquote x-data x- init="$('#name').addClass('invalid')">{{$message}}</blockquote>
                    @enderror
                </div>
                <div  class="col s12">
                    <div wire:ignore class="input-field">
                        <input type="text" wire:model="key" id="key" placeholder="key">
                    </div>
                    @error('key')
                    <blockquote x-data x-init="$('#key').addClass('invalid')">{{$message}}</blockquote>
                    @enderror
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button wire:click="closeForm" wire:loading.attr="disabled" type="button" class="btn waves-effect transparent red-text btn-small">
                Close <i class="material-icons right red-text">close</i>
            </button>
            <button type="submit" class="btn waves-effect transparent green-text btn-small">
                {{$rule_id==0?'Save':'Update'}} <i class="material-icons right green-text">save</i>
            </button>
        </div>
    </form>
</div>
