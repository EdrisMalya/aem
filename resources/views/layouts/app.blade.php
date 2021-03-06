{{--@props([
    'title',
    'active',
])--}}
<x-base :title="$title" :active="$active">
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
                            <img width="100%" src="{{asset('storage/'.auth()->user()->profile)}}" class="profile-user-img" />
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
                        <a class="black-text" href="{{route('profile')}}">
                            <i class="material-icons left">person_outline</i>
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
    <form action="{{route('logout')}}" id="logoutForm" method="post">
        @csrf
    </form>
    @include('inc.navbar')
    <div id="content">
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

</x-base>
