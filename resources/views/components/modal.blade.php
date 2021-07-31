@php $id = uniqid(); @endphp
<div id="modal{{$id}}" {{$attributes}} {{$attributes->merge(['class'=>'modal'])}} x-data x-init="$('.modal').modal({dismissible:false}); M.Modal.getInstance($('#modal{{$id}}')).open()">
    {{$slot}}
</div>
