<?php

namespace App\Http\Livewire\User\Authorization\Roles;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Form extends Component
{
    public $name;
    public $key;
    public $rule_id;
    public $category_id;

    public function mount($rule_id,$category_id)
    {
        auth()->user()->allow('v');
        $this->rule_id = $rule_id;
        $this->category_id = $category_id;
        if ($rule_id!=0){
            $rule = \App\Models\Rule::find($rule_id);
            $this->name = $rule->name;
            $this->key = $rule->key;
        }
    }

    public function saveRule()
    {
        $data = $this->validate([
            'name' => 'required|string|min:3|max:100',
            'key' => ['required','string','min:3']
        ]);
        if (\App\Models\Rule::where(['key'=>$data['key'],'authorization_category_id'=>$this->category_id])->count() > 0){
            $this->validate([
                'key' => [Rule::unique('rules')->ignore($this->rule_id)]
            ]);
        }
        $message = '';
        $data['authorization_category_id'] = $this->category_id;
        $data['key'] = Str::studly($data['key']);
        if ($this->rule_id == 0){
            \App\Models\Rule::create($data);
            $message = "Saved successfully";
        }else{
            \App\Models\Rule::where('id',$this->rule_id)->update($data);
            $message = "Updated successfully";
        }
        $this->emitUp('refresh',$this->category_id);
        $this->rule_id = 0;
        $this->dispatchBrowserEvent('notify',[
            'message' => $message,
            'classes' => 'green rounded'
        ]);
    }

    public function updatedName()
    {
        $this->key =  Str::studly($this->name);
    }

    public function closeForm()
    {
        $this->emitUp('refresh',$this->category_id);
    }
    public function render()
    {
        return view('livewire.user.authorization.roles.form');
    }
}
