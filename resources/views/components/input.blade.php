@props([
    'name',
    'label',
    'icon',
    'type'
])
<div wire:ignore class="input-field">
    @if(isset($icon))
        <i class="material-icons prefix">{{$icon}}</i>
    @endif
    <input type="{{$type??'text'}}" wire:model="{{$name}}" id="{{$name}}" {{$attributes}}>
    <label for="{{$name}}">{{$label}}</label>
</div>
@error($name)
<blockquote x-data x-init="$('#{{$name}}').addClass('invalid')">{{$message}}</blockquote>
@enderror
