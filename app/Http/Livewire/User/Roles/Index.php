<?php

namespace App\Http\Livewire\User\Roles;

use App\Models\Role;
use App\Models\Rule;
use App\Models\User;
use Livewire\Component;

class Index extends Component
{
    public $createFrom = false;
    public $deleteConfirm = false;
    public $role_id = 0;
    public $roles = [];
    protected $listeners = ['closeForm','refresh'];

    public function mount()
    {
        if (!User::allow()){
            abort(401);
        }
        $this->roles = Role::all();
    }

    public function closeForm()
    {
        $this->createFrom = false;
    }

    public function refresh($message)
    {
        $this->roles = Role::all();
        $this->createFrom = false;
        $this->editFrom = false;
        $this->dispatchBrowserEvent('notify',[
            'message' => $message,
            'classes' => 'green rounded'
        ]);
    }

    public function deleteModal($role_id)
    {
        $this->role_id = $role_id;
        $this->deleteConfirm = true;
    }

    public function delete()
    {
        $this->deleteConfirm = false;
        if (\DB::table('assigned_rules')->where('rule_id','=',$this->role_id)->count() > 0){
            $this->dispatchBrowserEvent('notify',[
                'message' => 'Cannot delete because some rules is attached',
                'classes' => 'red rounded'
            ]);
        }else{
            Role::find($this->role_id)->delete();
            $this->roles = Role::all();
            $this->dispatchBrowserEvent('notify',[
                'message' => 'Deleted successfully',
                'classes' => 'green rounded'
            ]);
        }
    }

    public function render()
    {
        return view('livewire.user.roles.index',[
            'roles' => $this->roles
        ]);
    }
}
