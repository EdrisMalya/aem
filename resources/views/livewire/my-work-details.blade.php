<div>
    <div class="modal-content">
        @if($parent_task!=null)
            <x-button class="btn-floating" wire:click="previousTask">
                <i class="material-icons">keyboard_arrow_left</i>
            </x-button>
        @endif
        <h5>
            {{$task->title}}
        </h5>
        @if($task->user_id == auth()->id())
            <span class="grey-text">
                <b>
                    Status:
                </b>
                {{$task->status}}<br><br>
                @if($task->status=='upcoming')
            <x-button wire:loading.attr="disabled" wire:click="moveToRunning">
                Move to running
                <i class="material-icons right">arrow_forward</i>
            </x-button>
            @elseif($task->status=='running')
                <x-button wire:loading.attr="disabled" wire:click="moveToUpcoming">
                    Move to Upcoming
                    <i class="material-icons right">arrow_back</i>
                </x-button>
                <x-button wire:loading.attr="disabled" wire:click="moveToCompleted">
                    Move to Completed
                    <i class="material-icons right">arrow_forward</i>
                </x-button>
            @elseif($task->status=='completed')
                <x-button wire:loading.attr="disabled" wire:click="moveToRunning">
                    Move to Running
                    <i class="material-icons left">arrow_back</i>
                </x-button>
            @endif
                <x-button wire:loading.attr="disabled" wire:click="$set('showDeleteModal',true)">
                    <span class="red-text">Delete</span>
                    <i class="material-icons right red-text">delete</i>
                </x-button>
                <x-button wire:loading.attr="disabled" wire:click="$toggle('edit_mode')">
                    <span class="orange-text">Edit</span>
                    <i class="material-icons right orange-text">edit</i>
                </x-button>
            </span>
        @endif
        <p>
            <b>Description</b>
        </p>
        @if($edit_mode)
            <x-editor name="description" :value="$task->description" />
            <x-button wire:loading.attr="disabled" wire:click="saveDescription">
                    <span class="green-text">
                        Save
                        <i class="material-icons right">save</i>
                    </span>
            </x-button>
        @else
            {!! $task->description !!}
        @endif
        @if($task->files->count() > 0)
            <table>
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Size</th>
                    <th>Extension</th>
                </tr>
                </thead>
                <tbody>
                @foreach($task->files as $file)
                    <tr>
                        <td>
                            <a href="{{asset('storage/'.$file->file)}}">
                                {{$file->file_name}}
                            </a>
                        </td>
                        <td>{{$file->file_size}}</td>
                        <td>{{$file->file_ext}}</td>
                        <td>
                            @if($edit_mode)
                                <x-button wire:loading.attr="disabled" wire:click="deleteFile('{{$file->id}}')">
                                    <i class="material-icons red-text">delete</i>
                                </x-button>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
        @if($edit_mode)
            <p>
                <b>Upload File</b>
            </p>
            <x-filepond name="files" multiple="true" />

            <x-button id="save" wire:loading.attr="disabled" wire:click="saveFiles('{{$task->id}}')">
                <span class="green-text">
                    Save
                    <i class="material-icons right">save</i>
                </span>
            </x-button>
        @endif
        <div class="col s12">
            <ul class="collapsible" x-data x-init="$('.collapsible').collapsible();">
                <li>
                    <div class="collapsible-header"><i class="material-icons">filter_list</i>Sub tasks</div>
                    <div class="collapsible-body">
                        @if($task->tasks->count() < 1)
                            <p class="center red-text my-4">No sub tasks found</p>
                        @else
                            <div class="row mt-3">
                                <div class="col s12 m4 border-right">
                                    <p>
                                        <b>Upcoming</b>
                                    </p>
                                    @if($task->tasks->where('status','=','upcoming')->count() > 0)
                                        <ol class="browser-default">
                                            @foreach($task->tasks->where('status','=','upcoming') as $u_task)
                                                <li>
                                                    {{$u_task->title}}
                                                    <button class="right" wire:click="taskDetails('{{$u_task->id}}','{{$task->id}}')">Details</button>
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
                                    @if($task->tasks->where('status','=','running')->count() > 0)
                                        <ol class="browser-default">
                                            @foreach($task->tasks->where('status','=','running') as $r_task)
                                                <li>
                                                    {{$r_task->title}}
                                                    <span class="right border-bottom blue-text c-pointer" wire:click="taskDetails('{{$r_task->id}}','{{$task->id}}')">Details</span>
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
                                    @if($task->tasks->where('status','=','completed')->count() > 0)
                                        <ol class="browser-default">
                                            @foreach($task->tasks->where('status','=','completed') as $c_task)
                                                <li>
                                                    {{$c_task->title}}
                                                    <span class="right border-bottom blue-text c-pointer" wire:click="taskDetails('{{$c_task->id}}','{{$task->id}}')">Details</span>
                                                </li>
                                            @endforeach
                                        </ol>
                                    @else
                                        <p class="red-text center mt-3">No record found</p>
                                    @endif
                                </div>
                            </div>
                        @endif
                        <x-button class="btn-floating" wire:click="$set('addSubTask',true)">
                            <i class="material-icons">add</i>
                        </x-button>
                    </div>
                </li>
            </ul>
            @if($addSubTask)
                @livewire('task-form',['user_id' => $user_id, 'task_id' => $task->id],key(time()))
            @endif
        </div>
    </div>
    <div class="modal-footer">
        <x-cancel wire:click="closeForm">
            Close
        </x-cancel>
    </div>
    @if($showDeleteModal)
        <x-confirmation deleteAction="delete" closeAction="set('showDeleteModal',false)" />
    @endif
    @if($showFileDeleteModal)
        <x-confirmation deleteAction="deleteFileAction('{{$task->id}}')" closeAction="set('showFileDeleteModal',false)" />
    @endif
</div>
