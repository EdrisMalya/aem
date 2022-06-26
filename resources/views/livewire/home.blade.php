<div>
    <x-layout active="index" title="Home">
        <nav class="pl-5 breadcrumb-nav grey lighten-4 z-depth-0 border-bottom" style="z-index:1">
            <div class="nav-wrapper">
                <div class="col s12">
                    <a href="{{route('index')}}" class="breadcrumb black-text">Home</a>
                    <a href="javascript:void(0)" style="cursor:text" class="breadcrumb disabled">My works</a>
                </div>
            </div>
        </nav>
        <div class="row mx-2">
            <div class="col s12">
                <h5 class="d-inline-block">
                    My works
                </h5>
                <x-button wire:click="$set('form',true)" class="mt-3 right">
                    Add task for me <i class="material-icons right">add</i>
                </x-button>
                @if(auth()->user()->user_id==0)
                    <x-button class="right mt-3" wire:click="$set('assignTask',true)" >
                        Add task for employees <i class="material-icons right">add</i>
                    </x-button>
                @endif
                @if(auth()->user()->user_id==0)
                    <div class="row">
                        <div class="col s12">
                            <ul class="collapsible popout">
                                <li>
                                    <div class="collapsible-header">
                                        <i class="material-icons">filter_list</i>
                                        List of my works
                                    </div>
                                    <div class="collapsible-body">
                                        @livewire('my-tasks',['user_id' => auth()->id()])
                                    </div>
                                </li>
                                <li>
                                    <div class="collapsible-header">
                                        <i class="material-icons">people</i>
                                        List of my employee works
                                    </div>
                                    <div class="collapsible-body">
                                        @if($users->count() < 1)
                                            <p class="center red-text my-5">No employee found</p>
                                        @else
                                            <ul class="collapsible">
                                                @foreach($users as $employee)
                                                    <li>
                                                        <div class="collapsible-header">
                                                            <a href="{{asset('storage/'.$employee->profile)}}" target="_blank">
                                                                <img src="{{asset('storage/'.$employee->profile)}}" height="40px;" alt="">
                                                            </a>
                                                            <span class="d-inline-block mt-3 ml-2 pl-3">
                                                                {{$employee->name}}
                                                                {{$employee->last_name}}
                                                            </span>
                                                        </div>
                                                        <div class="collapsible-body">
                                                            @livewire('my-tasks',['user_id' => $employee->id],key($employee->id))
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                        {{--@livewire('my-tasks')--}}
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                @else
                    @livewire('my-tasks',['user_id' => auth()->id()])
                @endif
            </div>
        </div>
        @if($form)
            <x-modal>
                @livewire('task-form')
            </x-modal>
        @endif
        @if($assignTask)
            <x-modal>
                @livewire('assing-task')
            </x-modal>
        @endif
    </x-layout>
    @include('inc.scripts',['ckeditor'=>true,'filepond'=>true,'sweetalert'=>true])
</div>
