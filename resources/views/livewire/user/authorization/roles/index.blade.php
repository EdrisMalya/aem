<div>
    @if(count($rules) < 1)
        <p class="center red-text py-3">No record found</p>
    @else
        <div class="mx-3" x-data>
            @foreach($rules as $rule)
                <p class="d-inline-block px-3">
                    <b>{{$rule->name}}</b>
                    <span class="right ml-2 mt-1">
                        @if(auth()->user()->allow('v','Authorizations',['EditRoles']))
                        <i class="material-icons orange-text tiny c-pointer" @click="$(event.target).addClass('black-text')" wire:click="editModel({{$rule->id}},{{$category->id}})">edit</i>
                        @endif
                        @if(auth()->user()->allow('v','Authorizations',['DeleteRoles']))
                        <i class="material-icons red-text tiny c-pointer" @click="$(event.target).addClass('black-text')" wire:click="deleteModel({{$rule->id}},{{$category->id}})">delete</i>
                        @endif
                    </span>
                    <br>
                    <span class="grey-text">{{$rule->key}}</span>
                </p>
            @endforeach
        </div>
        <br>
    @endif
    @if(auth()->user()->allow('v','Authorizations',['CreateRoles']))
    <button wire:loading.attr="disabled"  x-data @click="$(event.target).html(aem.spinner())" wire:click="$set('ruleForm',true)" class="btn waves-effect transparent black-text btn-floating btn-small">
        <i class="material-icons">add</i>
    </button>
    @endif
    @if($ruleForm)
        <div x-data class="modal" id="modal" x-init="$('.modal').modal({dismissible:false}); M.Modal.getInstance($('#modal')).open()">
            @livewire('user.authorization.roles.form',['rule_id'=>0,'category_id'=>$category->id],key(uniqid()))
        </div>
    @endif
    @if($showDelete)
        <div id="modal" class="modal" x-data x-init="$('.modal').modal({dismissible:false}); M.Modal.getInstance($('#modal')).open()">
            <div class="modal-content">
                <h4>Delete Row </h4>
                <p>Are you sure to delete this row?</p>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click="$set('showDelete',false)" class="modal-action modal-close waves-effect waves-red btn-flat ">Cancel</button>
                <button wire:click="deleteRule" wire:loading.attr="disabled" class="modal-action waves-effect waves-green btn-flat ">Yes</button>
            </div>
        </div>
    @endif
    @if($showEditForm)
        <x-modal>
            @livewire('user.authorization.roles.form',['rule_id'=>$rule_id,'category_id'=>$category->id],key(uniqid()))
        </x-modal>
    @endif
</div>
