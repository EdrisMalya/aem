<div>
    <x-slot name="title">Authorizations</x-slot>
    <x-slot name="active">authorization</x-slot>
    <nav class="pl-5 breadcrumb-nav grey lighten-4 z-depth-0 border-bottom" style="z-index:1">
        <div class="nav-wrapper">
            <div class="col s12">
                <a href="{{route('index')}}" class="breadcrumb black-text">Home</a>
                <a href="javascript:void(0)" style="cursor:text" class="breadcrumb disabled">Authorizations</a>
            </div>
        </div>
    </nav>
    <div class="row mx-2">
        <div class="col s12" wire:ignore>
            <h5 class="d-inline-block">
                Authorizations
            </h5>
            <x-loading />
            @if(auth()->user()->allow('v','Authorizations',['CreateCategory']))
                <button wire:loading.attr="disabled" wire:loading.attr="disabled" wire:click="createCategory" class="btn waves-effect transparent black-text browser-default mt-3 right">Add new category <i class="material-icons right">add</i></button>
            @endif
        </div>
        <div class="col s12">
            @if(count($categories) < 1)
                <p class="center red-text py-5">
                    No record found
                </p>
            @else
                <ul x-data x-init="$('.collapsible').collapsible()" class="collapsible popout">
                    @foreach($categories as $category)
                        <li>
                            <div class="collapsible-header">
                                <i class="material-icons">filter_list</i>{{$category->name}}
                                <div style="margin-right: 0; position: absolute; right: 50px;">
                                    @if(auth()->user()->allow('v','Authorizations',['EditCategory']))
                                        <button x-data x-ref="button2__{{$category->id}}" @click="$(event.target).html(`<span class='spinner-border spinner-border-sm'></span>`).prop('disabled',true)" wire:click="editCategory('{{$category->id}}')" class="btn waves-effect transparent z-depth-0 btn-floating btn-small black-text">
                                            <i @click="$refs.button2__{{$category->id}}.click()" class="material-icons tiny orange-text">edit</i>
                                        </button>
                                    @endif
                                    @if(auth()->user()->allow('v','Authorizations',['DeleteCategory']))
                                        <button x-data x-ref="button__{{$category->id}}" @click="$(event.target).html(`<span class='spinner-border spinner-border-sm'></span>`).prop('disabled',true)" wire:click="ConfirmDeleteCategory({{$category->id}})" class="btn waves-effect transparent z-depth-0 btn-floating btn-small black-text">
                                            <i @click="$refs.button__{{$category->id}}.click()" class="material-icons tiny red-text">delete</i>
                                        </button>
                                    @endif
                                </div>
                            </div>
                            <div class="collapsible-body">
                                @if(auth()->user()->allow('v','Authorizations',['ViewRoles']))
                                    @livewire('user.authorization.roles.index',['category'=>$category->id], key($category->id))
                                @else
                                    <p align="center" class="red-text">You dont have permission to see roles</p>
                                @endif
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
    @if($categoryForm)
        <div x-data class="modal" id="modal" x-init="$('.modal').modal({dismissible:false}); M.Modal.getInstance($('#modal')).open()">
            @livewire('user.authorization.category.form',['model_id'=>$categoryId])
        </div>
    @endif
    @if($showDelete)
        <div id="modal" class="modal" x-data x-init="$('.modal').modal({dismissible:false}); M.Modal.getInstance($('#modal')).open()">
            <div class="modal-content">
                <h4>Delete Row </h4>
                <p>Are you sure to delete this row?</p>
            </div>
            <div class="modal-footer">
                <a href="#!" class="modal-action modal-close waves-effect waves-red btn-flat ">Cancel</a>
                <button wire:click="deleteCategory" wire:loading.attr="disabled" class="modal-action waves-effect waves-green btn-flat ">Yes</button>
            </div>
        </div>
    @endif
</div>
