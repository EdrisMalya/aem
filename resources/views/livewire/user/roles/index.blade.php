<div>
    <x-slot name="title">Roles</x-slot>
    <x-slot name="active">roles</x-slot>
    <nav class="pl-5 breadcrumb-nav grey lighten-4 z-depth-0 border-bottom" style="z-index:1">
        <div class="nav-wrapper">
            <div class="col s12">
                <a href="{{route('index')}}" class="breadcrumb black-text">Home</a>
                <a href="javascript:void(0)" style="cursor:text" class="breadcrumb disabled">Roles</a>
            </div>
        </div>
    </nav>
    <div class="row mx-2">
        <div class="col s12" wire:ignore>
            <h5 class="d-inline-block">
                Roles
            </h5>
            @if(auth()->user()->allow('v','Rules',['CreateRules']))
                <button wire:loading.attr="disabled" wire:loading.attr="disabled" wire:click="$set('createFrom',true)" class="btn waves-effect transparent black-text browser-default mt-3 right">Add new role <i class="material-icons right">add</i></button>
            @endif
        </div>
        <div class="col s12">
            @if($roles->count() < 1)
                <p class="center red-text my-5">
                    No record found
                </p>
            @else
                <br>
                @foreach($roles as $role)
                    <div class="chip">
                        <a class="black-text" href="{{route('assigned.roles',$role)}}">
                            {{$role->name}}
                        </a>
                        @if(auth()->user()->allow('v','Rules',['DeleteRules']))
                            <i class="material-icons" wire:click="deleteModal('{{$role->id}}')" style="cursor: pointer; float: right; font-size: 16px; line-height: 32px; padding-left: 8px;">delete</i>
                        @endif
                    </div>
                @endforeach
            @endif
        </div>
    </div>
    @if($createFrom)
        <x-modal>
            @livewire('user.roles.form',['rule_id'=>$role_id])
        </x-modal>
    @endif
    @if($deleteConfirm)
        <x-modal>
            <div class="modal-content">
                <h4>Delete Row </h4>
                <p>Are you sure to delete?</p>
            </div>
            <div class="modal-footer">
                <a href="#!" class="modal-action modal-close waves-effect waves-red btn-flat ">Cancel</a>
                <button wire:click="delete" wire:loading.attr="disabled" class="modal-action waves-effect waves-green btn-flat ">Yes</button>
            </div>
        </x-modal>
    @endif
</div>
