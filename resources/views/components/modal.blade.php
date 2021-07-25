<div id="modal" class="modal" x-data x-init="$('.modal').modal({dismissible:false}); M.Modal.getInstance($('#modal')).open()">
    {{$slot}}
</div>
