<?php

namespace App\Http\Livewire\User\Roles;

use App\Models\User;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Form extends Component
{
    public $name;
    public $role_id;

    public function mount()
    {
        auth()->user()->allow('v','Rules',['CreateRules']);
    }
    public function closeForm()
    {
        $this->emitUp('closeForm');
    }

    public function saveRole()
    {
        $data = $this->validate([
            'name' => ['string','required','min:3',Rule::unique('roles')->ignore($this->role_id)]
        ]);
        $message = '';
        if ($this->role_id==0){
            $role = \App\Models\Role::create($data);
            $this->dispatchBrowserEvent('notify',[
                'message' => 'Created successfully',
                'classes' => 'green rounded'
            ]);
            return redirect()->to(route('assigned.roles',$role));
        }else{
            \App\Models\Role::find($this->role_id)->update($data);
            $message = 'Updated successfully';
        }
        $this->emitUp('refresh',$message);
    }
    public function render()
    {
        return view('livewire.user.roles.form');
    }
}
