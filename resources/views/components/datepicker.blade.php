@include('inc.scripts',['datepicker'=>true])
@props([
    'name',
    'label' => null,
    'format' => 'MM/DD/YYYY',
    'placeholder' => null
])
<div class="col s12 input-field" x-data="{}" x-init="
    ()=>{
        setTimeout(
            ()=>{
                new Pikaday({field: $refs.{{$name}}, format: '{{$format}}'})
            },500)
        }"
     @change="$dispatch('{{$name}}',$event.target.value)"
>
    <div class="input-field" wire:ignore>
        <label for="{{$name}}">{{$label}}</label>
        <input autocomplete="off" type="text" x-ref="{{$name}}" @if($placeholder!=null) placeholder="{{$placeholder}}" @endif id="{{$name}}" wire:model.lazy="{{$name}}">
    </div>
    @error('datepicker') <span class="red-text">{{$message}}</span> @enderror
</div>
