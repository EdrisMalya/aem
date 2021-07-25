<div>
    <x-layout title="index" active="user.index">
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
                <a data-turbolink="false" href="{{route('create.user')}}" class="btn waves-effect transparent black-text mt-3 right">Add new user <i class="material-icons right">add</i></a>
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
                                <td>{{$user->role->name}}</td>
                                <td>
                                    <a href="">
                                        <i class="material-icons tiny orange-text">edit</i>
                                    </a>
                                    <a href="">
                                        <i class="material-icons tiny red-text">delete</i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </x-datatable>
            </div>
        </div>
    </x-layout>
</div>
@push('css')
    @include('inc.scripts',['type'=>'css','buttons'=>true])
@endpush
@push('js')
    @include('inc.scripts',['type'=>'js','buttons'=>true])
@endpush
