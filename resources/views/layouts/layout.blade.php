<x-slot name="title">{{$title}}</x-slot>
<nav style="height:60px; position:fixed; z-index:999;" class="white black-text z-depth-1">
    <div style="height:100%; line-height:60px;" class="px-3 blue d-inline-block left waves-effect" onclick="aem.collapseSidebar()">
        <i class="material-icons white-text large">menu</i>
        <input type="checkbox" id="mobile-mode" />
    </div>
    <ul class="left ml-3">
        <li>
            <h5 style="font-weight:bolder" id="min-title">
                {{ucfirst(implode(' ',explode('-',\Illuminate\Support\Str::kebab(env('app_name')))))}}
            </h5>
        </li>
    </ul>
    <ul class="right">
        <li class="px-3">
            <a href="#dropdown1"  class="black-text browser-default waves-effect waves-block dropdown-trigger">
                <div style="display:flex; flex-direction:row" class="mr-4">
                        <span class="profile-avatar mt-2">
                            @if (auth()->user()->profile != null)
                                <img width="100%" src="{{asset('storage/'.auth()->user()->image)}}]" class="profile-user-img" />
                            @else
                                <img width="100%" src="{{asset('img/user.png')}}" class="profile-user-img"/>
                            @endif
                        </span>
                    <div class="ml-3">
                        {{auth()->user()->name}}
                        {{auth()->user()->last_name}}
                        <i class="material-icons right mt-1">arrow_drop_down</i>
                    </div>
                </div>
            </a>
            <ul id='dropdown1' class='dropdown-content'>
                <li>
                    <a class="black-text modal-trigger" href="#change_password_modal">
                        <i class="material-icons left">lock_outline</i>
                        Change password
                    </a>
                </li>
                <li>
                    <a class="black-text" href="@Url.Action("MyProfile","Manage")">
                    <i class="material-icons left">person_outline   </i>
                    Profile
                    </a>
                </li>
                <li class="divider" tabindex="-1"></li>
                <li>
                    <a class="black-text" href="javascript:document.getElementById('logoutForm').submit()">Logout</a>
                </li>
            </ul>
        </li>
    </ul>
</nav>
<div class="modal modal-fixed-footer" id="change_password_modal">
    <div class="modal-content">
        <div class="row mx-2">
            <div class="col s12">
                <h5 class="card-title">Change password</h5>
            </div>
            <div class="col s12 input-field">
                <input type="password" name="OldPassword" id="OldPassword" required />
                <label for="OldPassword">Old password</label>
            </div>
            <div class="col s12 input-field">
                <input type="password" name="NewPassword" id="NewPassword" required />
                <label for="NewPassword">New password</label>
            </div>
            <div class="col s12 input-field">
                <input type="password" name="ConfirmPassword" id="ConfirmPassword" required />
                <label for="ConfirmPassword">Confirm password</label>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn waves-effect btn-small transparent black-text">
            Save <i class="material-icons right green-text">save</i>
        </button>
        <button type="button" class="btn waves-effect btn-small transparent modal-close black-text">
            Cancel <i class="material-icons right red-text">close</i>
        </button>
    </div>
</div>
@include('inc.navbar')
<div id="content" {{$attributes}}>
    {{$slot}}
</div>
@if (session()->has('message'))
    <script>
        M.toast({
            html: '{{session()->get('message')}}',
            classes: '{{session()->has('classes')?session()->get('classes'):'green rounded'}}'
        });
    </script>
@endif
@if(isset($js))
    <x-slot name="js">
        {{$js}}
    </x-slot>
@endif
@if(isset($css))
    <x-slot name="css">
        {{$css}}
    </x-slot>
@endif
