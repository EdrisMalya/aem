<div wire:ignore class="aem-sidebar z-depth-4" id="scroll">
    <div class="center">
        <span class="mt-2" id="profile-img">
            @if (auth()->user()->profile != null)
                <img width="100%" src="{{asset('storage/'.auth()->user()->image)}}]" class="profile-user-img" />
            @else
                <img width="100%" src="{{asset('img/user.png')}}" class="profile-user-img"/>
            @endif
        </span><br/>
        <span class="mt-2 d-inline-block">
            <b>
                {{auth()->user()->name}} {{auth()->user()->last_name}}
            </b>
        </span>
    </div>
    <ul class="aem-sidebar-items">
        <li class="mt-2">
            <a href="javascript:void(0)" onclick="aem.toggleElemnt(event,'#dashboard')">
                <i class="material-icons left parent">keyboard_arrow_right</i>
                Dashboard
            </a>
            <ul class="aem-sidebar-items" id="dashboard" style="display:none;">
                <li class="mt-2 {{$active=="index"?'active':''}}">
                    <a href="{{route('index')}}">
                        <i class="material-icons left">remove</i>
                        Index
                    </a>
                </li>
            </ul>
        </li>
        @if(\App\Models\User::allow())
            <li class="mt-2">
                <a href="javascript:void(0)" onclick="aem.toggleElemnt(event,'#user_management')">
                    <i class="material-icons left parent">keyboard_arrow_right</i>
                    User management
                </a>
                <ul class="aem-sidebar-items" id="user_management" style="display:none;">
                    <li class="mt-2 {{$active=="user.index"?'active':''}}">
                        <a href="{{route('user.index')}}">
                            <i class="material-icons left">remove</i>
                            Users
                        </a>
                    </li>
                    <li class="mt-2 {{$active=="roles"?'active':''}}">
                        <a href="{{route('roles.index')}}">
                            <i class="material-icons left">remove</i>
                            Rules
                        </a>
                    </li>
                    <li class="mt-2 {{$active=="authorization"?'active':''}}">
                        <a href="{{route('authorization.index')}}">
                            <i class="material-icons left">remove</i>
                            Authorizations
                        </a>
                    </li>
                </ul>
            </li>
        @endif
    </ul>
</div>
