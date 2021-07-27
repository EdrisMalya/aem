<div>
    <x-slot name="css">
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    </x-slot>
    <x-slot name="js">
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    </x-slot>
    <x-layout :title="$user->email==null?'Create user':'Edit user'" active="user.index">
        <nav class="pl-5 breadcrumb-nav grey lighten-4 z-depth-0 border-bottom" style="z-index:1">
            <div class="nav-wrapper">
                <div class="col s12">
                    <a href="{{route('index')}}" class="breadcrumb black-text">Home</a>
                    <a href="{{route('user.index')}}" class="breadcrumb black-text">Users</a>
                    <a href="javascript:void(0)" style="cursor:text" class="breadcrumb disabled">Create User</a>
                </div>
            </div>
        </nav>
        <form wire:submit.prevent="save">
            <div class="row mx-2">
                <div class="col s12 center mt-2">
                    <span wire:ignore id="profile-img" class="border">
                        <img src="{{$img}}" width="100%" id="image" alt="">
                    </span>
                    <br>
                    <label for="img_input" class="btn waves-effect btn-small transparent btn-floating z-depth-0">
                        <i class="tiny material-icons orange-text">attach_file</i>
                    </label>
                    <input type="file" wire:model="profile" class="d-none" id="img_input">
                </div>
                <div class="col s12">
                    @error('profile')
                    <blockquote x-data x-init="$('#profile-img').hide()">
                        {{$message}}
                    </blockquote>
                    @enderror
                </div>
                <div class="col s12">
                    <div class="container">
                        <div class="row">
                            <div class="col s12 m6">
                                <x-input name="name" label="First Name" />
                            </div>
                            <div class="col s12 m6">
                                <x-input name="last_name" label="Last Name" />
                            </div>
                            <div class="col s12 m6">
                                <x-select placeholder="Select Role (required)" name="role_id">
                                    @foreach($roles as $role)
                                        <option value="{{$role->id}}">{{$role->name}}</option>
                                    @endforeach
                                </x-select>
                            </div>
                            <div class="col s12 m6">
                                <x-select placeholder="Manager" name="manager_id">
                                    <option value="0">Null</option>
                                    @foreach($users as $user)
                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                    @endforeach
                                </x-select>
                            </div>
                            <div class="col s12">
                                <x-input name="email" label="Email" icon="email" :disabled="$email!=null?true:false" />
                            </div>
                            <div class="col s12 m6">
                                <x-input name="password" label="Password" icon="lock_outline" type="password" />
                            </div>
                            <div class="col s12 m6">
                                <x-input name="confirm_password" label="Confirm Password" icon="lock_outline" type="password" />
                            </div>
                            <div class="col s12">
                                <button type="submit" class="btn waves-effect transparent black-text">
                                    Save <i class="material-icons right">save</i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </x-layout>
</div>

