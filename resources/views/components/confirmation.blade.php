<div x-data="" x-init="
    setTimeout(()=>{
        swal({
            icon: '{{$icon??'info'}}',
            title: '{{$title??'Are you sure'}}',
            text: '{{$text??'Once deleted recovery is not possible'}}',
            buttons: true,
        }).then((result)=>{
            if(result){
                @this.{{$deleteAction}}()
            }else{
                @this.{{$closeAction}}
            }
        });
    },100);
"></div>
