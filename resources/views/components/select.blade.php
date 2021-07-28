<div wire:ignore>
    <label for="role"><b>{{ucfirst(str_replace(['id','_','-'],['','',''],strtolower($name)))}}</b></label>
    <select placeholder="{{$placeholder}}" {{$attributes    }} class="browser-default" x-data="" x-ref="{{$name}}" x-init="()=>{
            setTimeout(()=>{
                $($refs.{{$name}}).selectize();
            },100);
        }" wire:model="{{$name}}" onchange="@this.set('{{$name}}',$(event.target).val())" id="{{$name}}">
        <option value="" selected></option>
        {{$slot}}
    </select>
</div>
@error($name)
<blockquote>{{$message}}</blockquote>
@enderror
