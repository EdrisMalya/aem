<div>
    <x-layout title="Assigned Rules" active="roles">
        <nav class="pl-5 breadcrumb-nav grey lighten-4 z-depth-0 border-bottom" style="z-index:1">
            <div class="nav-wrapper">
                <div class="col s12">
                    <a href="{{route('index')}}" class="breadcrumb black-text">Home</a>
                    <a href="{{route('roles.index')}}" class="breadcrumb black-text">Rules</a>
                    <a href="javascript:void(0)" style="cursor:text" class="breadcrumb disabled">{{$role->name}}</a>
                </div>
            </div>
        </nav>
        <div class="row mx-2">
            <div class="col s12">
                <h5 class="d-inline-block">
                    Assigned Rules
                </h5>
            </div>
            <form wire:submit.prevent="save">
                <div class="col s12 m3 input-field">
                    <x-input name="name" label="Rule name"></x-input>
                </div>
                <div class="col s12">
                    @if(count($categories) < 1)
                        <p class="center red-text py-5">
                            No record found
                        </p>
                    @else
                        <ul wire:ignore x-data x-init="$('.collapsible').collapsible()" class="collapsible">
                            @foreach($categories as $category)
                                <li>
                                    <div class="collapsible-header">
                                        <i class="material-icons">filter_list</i>{{$category->name}}
                                    </div>
                                    <div class="collapsible-body">
                                        <div class="row">
                                            @foreach($category->rules as $rule)
                                                <div class="col s12 m3">
                                                    <p>
                                                        <label>
                                                            <input type="checkbox" wire:click="levelClicked('{{$rule->id}}')" wire:model="selected_roles" value="{{$rule->id}}" />
                                                            <span>{{$rule->name}}</span><br>
                                                            <span style="margin-left: 35px">{{$rule->key}}</span>
                                                        </label>
                                                    </p>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
                <div class="col s12">
                    <button {{count($selected_roles) < 1?'disabled':''}} class="btn waves-effect transparent black-text" @click="$(event.target).html(aem.spinner()).prop('disabled',true)" type="submit">
                        Save <i class="material-icons right">save</i>
                    </button>
                </div>
            </form>
        </div>
    </x-layout>
</div>
