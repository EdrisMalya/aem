<?php

namespace App\Http\Livewire\User\Authorization\Roles;

use App\Models\AuthorizationCategory;
use App\Models\Rule;
use App\Models\User;
use Livewire\Component;

class Index extends Component
{
    public $category;
    public $ruleForm = false;
    public $showDelete = false;
    public $rule_id=0;
    public $showEditForm = false;

    protected $listeners = ['refresh'];

    public function refresh(AuthorizationCategory $category_id)
    {
        if (!User::allow()){
            abort(401);
        }
        $this->ruleForm = false;
        $this->category = $category_id;
        $this->showEditForm = false;
        $this->rule_id = 0;
    }
    public function mount(AuthorizationCategory $category)
    {
        $this->category = $category;
    }

    public function deleteModel($id, AuthorizationCategory $category)
    {
        $this->rule_id = $id;
        $this->showDelete = true;
        $this->category = $category;
    }
    public function editModel($id, AuthorizationCategory $category)
    {
        $this->rule_id = $id;
        $this->showEditForm = true;
        $this->category = $category;
    }

    public function deleteRule()
    {
        Rule::where('id',$this->rule_id)->delete();
        $this->category = AuthorizationCategory::find($this->category->id);
        $this->dispatchBrowserEvent('notify',[
            'message' => 'Deleted successfully',
            'classes' => 'green rounded'
        ]);
        $this->showDelete = false;
    }
    public function render()
    {
        return view('livewire.user.authorization.roles.index',[
            'rules' => $this->category->rules
        ]);
    }
}
