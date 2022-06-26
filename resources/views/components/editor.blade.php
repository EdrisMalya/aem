<div wire:ignore>
    <label for="description">
        <b>{{$label??'Description'}}</b>
    </label>
    <div>
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
</div>
@error($name)
    <blockquote x-data x-init="$('#{{$name}}').parent('div').css('border','1px solid red')">{{$message}}</blockquote>
@enderror
