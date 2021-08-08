<div>
    <x-slot name="title">Users list</x-slot>
    <x-slot name="active">user.index</x-slot>
    <nav class="pl-5 breadcrumb-nav grey lighten-4 z-depth-0 border-bottom" style="z-index:1">
        <div class="nav-wrapper">
            <div class="col s12">
                <a href="{{route('index')}}" class="breadcrumb black-text">Home</a>
                <a href="javascript:void(0)" style="cursor:text" class="breadcrumb disabled">Users</a>
            </div>
        </div>
    </nav>
    <div class="row mx-2">
        <div class="col s12">
            <h5 class="d-inline-block">
                List of categories
            </h5>
            @if(auth()->user()->allow('v','Users',['CreateUser']))
                <a data-turbolink="false" href="{{route('user')}}" class="btn waves-effect transparent black-text mt-3 right">Add new user <i class="material-icons right">add</i></a>
            @endif
            <br /><br />
            <x-datatable :buttons="true" id="table1">
                <thead>
                <tr>
                    <th>No#</th>
                    <th>Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->last_name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->role!=null?$user->role->name:'Root Admin'}}</td>
                        <td>
                            @if(auth()->user()->allow('v','Users',['EditUser']))
                                <a href="{{route('user',$user)}}">
                                    <i class="material-icons tiny orange-text">edit</i>
                                </a>
                            @endif
                            @if(auth()->user()->allow('v','Users',['DeleteUser']))
                                <a class="c-pointer" wire:click="deleteForm('{{$user->id}}')">
                                    <i class="material-icons tiny red-text">delete</i>
                                </a>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </x-datatable>
        </div>
    </div>
    @if($showDelete)
        <div id="modal" class="modal" x-data x-init="$('.modal').modal({dismissible:false}); M.Modal.getInstance($('#modal')).open()">
            <div class="modal-content">
                <h4>Delete Row </h4>
                <p>Are you sure to delete this row?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="modal-action modal-close waves-effect waves-red btn-flat ">Cancel</button>
                <button wire:click="delete" wire:loading.attr="disabled" class="modal-action waves-effect waves-green btn-flat ">Yes</button>
            </div>
        </div>
    @endif
</div>
@include('inc.scripts',['datatable'=>true,'buttons'=>true])
