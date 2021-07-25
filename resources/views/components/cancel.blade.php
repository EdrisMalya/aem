<button wire:loading.attr="disabled" type="button" class="btn waves-effect modal-close transparent red-text btn-small" {{$attributes}}>
    {{$slot}} <i class="material-icons right red-text">close</i>
</button>
