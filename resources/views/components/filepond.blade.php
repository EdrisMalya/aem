<p>
    <b>{{$label??''}}</b>
</p>
<div
    class="col s12"
    wire:ignore
    x-data="{focused: false}"
    x-init="
        setTimeout(()=>{
            @if(isset($img))
                FilePond.registerPlugin(FilePondPluginImagePreview);
            @endif
            FilePond.setOptions({
                allowMultiple: {{$multiple??'false'}},
                    server: {
                        process:(fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
                            @this.upload('{{$name}}', file, load, error, progress)
                        },
                        revert: (filename, load)=>{
                            @this.removeUpload('{{$name}}',filename,load)
                        },
                        onload: function(){
                            $('#save').removeAttr('disabled');
                        }
                    },
                })
                const pond = FilePond.create($refs.{{$name}});
                pond.on('addfile', (error, file) => {
                    $('#save').prop('disabled',true)
                });
            },100);
        "
>
    <input type="file" x-ref="{{$name}}">
</div>
