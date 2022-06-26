<div>
    <form wire:submit.prevent="save">
        <div class="modal-content">
            <h5>
                <b>
                    @if($user_id!=0)
                        Assign Task
                    @else
                        Add your work
                    @endif
                </b>
            </h5>
            <div class="row">
                <div class="col s12">
                    <x-select name="status" placeholder="Work Status">
                        <option value="upcoming">Upcoming</option>
                        <option value="running">Running</option>
                        <option value="completed">Completed</option>
                    </x-select>
                </div>
                <div class="col s12">
                    @if($showFormFields)
                        <div class="col s12">
                            <x-input name="title" label="Title" />
                        </div>
                        <div class="col s12">
                            <x-editor name="description" label="Your description" />
                        </div>
                        <div class="row mt-1">
                            <div class="col s12 m6">
                                <x-input class="datepicker" type="date" name="start_date" label="Start Date" icon="date_range" />
                            </div>
                            <div class="col s12 m6">
                                <x-input class="datepicker" type="date" name="end_date" label="End Date" icon="date_range" />
                            </div>
                        </div>
                        <x-filepond name="files" multiple="true" label="Attach files if needed" />
                    @endif
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <x-save id="save">
                Save
            </x-save>
            @if(!$fromManager)
                <x-cancel wire:click="closeForm">
                    close
                </x-cancel>
            @endif
        </div>
    </form>
</div>
