<div wire:ignore>
    <label for="description">
        <b>{{$label??'Description'}}</b>
    </label>
    <textarea x-data x-init="
        setTimeout(()=>{
            CKEDITOR.replace('{{$name}}')
            .on('change', function(event){
                @this.set('{{$name}}', event.editor.getData());
            })
        },100)
        ;
    " id="{{$name}}" cols="30" rows="10">{{$value??''}}</textarea>
</div>
