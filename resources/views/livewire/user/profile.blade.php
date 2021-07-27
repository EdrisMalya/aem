<div>
    <x-layout title="Profile" active="">
        <form wire:submit.prevent="save">
            <div class="row mx-2 mt-5">
                <div class="col s12 center mt-2">
                <span wire:ignore id="profile-img" class="border">
                    <img src="{{$img}}" width="100%" id="image" alt="">
                </span>
                    <br>
                    <label for="img_input" class="btn waves-effect btn-small transparent btn-floating z-depth-0">
                        <i class="tiny material-icons orange-text">edit</i>
                    </label>
                    <input type="file" wire:model="profile" class="d-none" id="img_input">
                </div><div class="col s12 py-2"></div>
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
                                <x-input name="name" label="First Name" :disabled="true" />
                            </div>
                            <div class="col s12 m6">
                                <x-input name="last_name" label="Last Name" :disabled="true" />
                            </div>
                            <div class="col s12">
                                <x-input name="email" label="Email" icon="email" :disabled="true" />
                            </div>
                            <div class="col s12 m6">
                                <x-input name="role" label="My Role" :disabled="true" />
                            </div>
                            <div class="col s12 m6">
                                <x-input name="manager" label="My manager" :disabled="true" />
                            </div>
                            <div class="col s12 m6">
                                <x-input name="password" label="Password" icon="lock_outline" type="password" />
                            </div>
                            <div class="col s12 m6">
                                <x-input name="password_confirmation" label="Confirm Password" icon="lock_outline" type="password" />
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
