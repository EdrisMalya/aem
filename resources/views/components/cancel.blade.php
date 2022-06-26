<button  type="button" class="btn waves-effect modal-close transparent red-text btn-small" {{$attributes}} x-data @click="$(event.target).html(aem.spinner()).prop('disabled',true)">
    {{$slot}} <i class="material-icons right red-text">close</i>
</button>
