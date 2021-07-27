<?php

namespace App\Http\Livewire\User\Authorization\Category;

use App\Models\AuthorizationCategory;
use App\Models\User;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Form extends Component
{
    public $model_id;
    public $name;

    public function mount($model_id)
    {
        auth()->user()->allow('v');
        $this->model_id = $model_id;
        if ($this->model_id!=0){
            $category = AuthorizationCategory::find($this->model_id);
            $this->name = $category->name;
            $this->model_id = $category->id;
        }
    }

    public function closeForm()
    {
        $this->model_id = 0;
        $this->emitUp('closeForm');
    }

    public function saveCategory()
    {
        $data = $this->validate([
            'name' => ['required','string',Rule::unique('authorization_categories')->ignore($this->model_id)]
        ]);
        $message = '';
        $data['name'] = \Str::studly($data['name']);
        if ($this->model_id==0){
            AuthorizationCategory::create($data);
            $message = 'Saved successfully';
        }else{
            AuthorizationCategory::where('id',$this->model_id)->update($data);
            $message = 'Updated successfully';
        }
        $this->emitUp('refreshCategories');
        $this->dispatchBrowserEvent('notify',[
            'message' => $message,
            'classes' => 'green rounded'
        ]);
    }
    public function render()
    {
        return view('livewire.user.authorization.category.form');
    }
}
