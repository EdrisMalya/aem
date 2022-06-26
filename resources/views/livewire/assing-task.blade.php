<div>
    <div class="modal-content">
        <h5>
            <b>Assign task for your employees</b>
        </h5>
        <div class="row">
            <div class="col s12">
                @if(count($users))
                    <x-select name="user_id" placeholder="List of employees">
                        @foreach($users as $user)
                            <option value="{{$user->id}}">{{$user->name}} {{$user->last_name}}</option>
                        @endforeach
                    </x-select>
                @else
                    <p class="center red-text my-5 red-text">No employee found</p>
                @endif
                @if($user_id!=0)
                    @livewire('task-form',['task_id' => 0, 'user_id' => $user_id])
                @endif
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <x-cancel wire:click="closeForm">
            Close
        </x-cancel>
    </div>
</div>
