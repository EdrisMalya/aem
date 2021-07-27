<?php

namespace App\Http\Livewire\User\Roles;

use App\Models\AssignedRules;
use App\Models\AuthorizationCategory;
use App\Models\Role;
use App\Models\User;
use Illuminate\Validation\Rule;
use Livewire\Component;

class AssignedRoles extends Component
{
    public $role;
    public $categories=[];
    public $name;
    public $selected_roles = [];

    public function mount(Role $role)
    {
        auth()->user()->allow('v');
        $this->selected_roles = \DB::table('assigned_rules')->where('rule_id','=',$role->id)->pluck('role_id')->toArray();
        $this->role = $role;
        $this->categories = AuthorizationCategory::all();
        $this->name = $role->name;
    }
    public function save()
    {
        if(count($this->selected_roles) < 1 ){
            $this->dispatchBrowserEvent('notify',[
                'message' => 'You must select at lease one role',
                'classes' => 'red rounded'
            ]);
        }else{
            AssignedRules::where('rule_id','=',$this->role->id)->delete();
            foreach ($this->selected_roles as $role){
                AssignedRules::create([
                    'rule_id' => $this->role->id,
                    'role_id' => $role
                ]);
            }
            $data = $this->validate([
                'name' => ['required','string','min:3',Rule::unique('roles')->ignore($this->role->id)]
            ]);
            $this->role->update($data);
            $this->dispatchBrowserEvent('notify',[
                'message' => 'Saved successfully',
                'classes' => 'green rounded'
            ]);
        }
    }

    public function levelClicked($id)
    {
        AssignedRules::where([
            'rule_id' => $this->role->id,
            'role_id' => $id
        ])->delete();
    }

    public function render()
    {
        return view('livewire.user.roles.assigned-roles');
    }
}
