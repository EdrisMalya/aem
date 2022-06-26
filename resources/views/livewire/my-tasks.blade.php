<div>
    @if($tasks->count() < 1)
        <p class="center red-text my-5">No record found</p>
    @else
        <div class="row mt-3">
            <div class="col s12 m4 border-right">
                <p>
                    <b>Upcoming</b>
                </p>
                @if($upcoming_tasks->count() > 0)
                    <ol class="browser-default">
                        @foreach($upcoming_tasks as $u_task)
                            <li class="mt-2">
                                    <span class="d-inline-block">
                                        {{$u_task->title}}
                                        <small class="grey-text">
                                            {{date('Y-M-d',strtotime($u_task->start_date))}} - {{date('Y-M-d',strtotime($u_task->expire_date))}}
                                        </small>
                                        <br>
                                        
                                    </span>
                                <small>
                                    @if($u_task->from_user_id!=0)
                                        <span class="red-text">
                                            | Assigned From: <b>{{\App\Models\User::find($u_task->from_user_id)->name}} {{\App\Models\User::find($u_task->from_user_id)->last_name}}</b>
                                        </span>
                                    @endif
                                </small>
                                <button class="right mr-0" wire:click="taskDetails('{{$u_task->id}}')">Details</button>
                            </li>
                        @endforeach
                    </ol>
                @else
                    <p class="red-text center mt-3">No record found</p>
                @endif
            </div>
            <div class="col s12 m4 border-right">
                <p>
                    <b>Running</b>
                </p>
                @if($running_tasks->count() > 0)
                    <ol class="browser-default">
                        @foreach($running_tasks as $r_task)
                            <li class="mt-2">
                                    <span class="d-inline-block">
                                        {{$r_task->title}} 
                                        <small class="grey-text">
                                            {{date('Y-M-d',strtotime($r_task->start_date))}} - {{date('Y-M-d',strtotime($r_task->expire_date))}}
                                        </small>
                                    </span>
                                <small>
                                    @if($r_task->from_user_id!=0)
                                        <span class="red-text">
                                            | Assigned From: <b>{{\App\Models\User::find($r_task->from_user_id)->name}} {{\App\Models\User::find($r_task->from_user_id)->last_name}}</b>
                                        </span>
                                    @endif
                                </small>
                                <button class="right mr-0" wire:click="taskDetails('{{$r_task->id}}')">Details</button>
                            </li>
                        @endforeach
                    </ol>
                @else
                    <p class="red-text center mt-3">No record found</p>
                @endif
            </div>
            <div class="col s12 m4 border-right">
                <p>
                    <b>Completed</b>
                </p>
                @if($completed_tasks->count() > 0)
                    <ol class="browser-default">
                        @foreach($completed_tasks as $r_task)
                            <li class="mt-2">
                                    <span class="d-inline-block">
                                        {{$r_task->title}}
                                        <small class="grey-text">
                                            {{date('Y-M-d',strtotime($r_task->start_date))}} - {{date('Y-M-d',strtotime($r_task->expire_date))}}
                                        </small>
                                    </span>
                                <small>
                                    @if($r_task->from_user_id!=0)
                                        <span class="red-text">
                                            | Assigned From: <b>{{\App\Models\User::find($r_task->from_user_id)->name}} {{\App\Models\User::find($r_task->from_user_id)->last_name}}</b>
                                        </span>
                                    @endif
                                </small>
                                <button class="right mr-0" wire:click="taskDetails('{{$r_task->id}}')">Details</button>
                            </li>
                        @endforeach
                    </ol>
                    @if($user_id==auth()->id())
                        <a href="{{route('report')}}" class="btn waves-effect transparent black-text btn-small">
                            generate report
                        </a>
                    @endif
                @else
                    <p class="red-text center mt-3">No record found</p>
                @endif
            </div>
        </div>
    @endif
    @if($task_details)
        <x-modal style="height: 100%;width: 90%;">
            @livewire('my-work-details',['id'=>$task->id],key($task->id))
        </x-modal>
    @endif
    @if($deleteModel)
        <x-modal class="modal-fixed-footer">
            <div class="modal-content">
                <h4>Delete Row </h4>
                <p>Are you sure to delete this row?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="modal-action modal-close waves-effect waves-red btn-flat ">Cancel</button>
                <button wire:click="delete" wire:loading.attr="disabled" class="modal-action waves-effect waves-green btn-flat ">Yes</button>
            </div>
        </x-modal>
    @endif
</div>
