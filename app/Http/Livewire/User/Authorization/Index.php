<?php

namespace App\Http\Livewire\User\Authorization;

use App\Models\AuthorizationCategory;
use App\Models\User;
use Livewire\Component;

class Index extends Component
{
    public $categoryForm = false;
    public $categories = [];
    public $showDelete = false;
    public $categoryId;
    protected $listeners = ['closeForm','refreshCategories'];

    public function mount()
    {
        auth()->user()->allow('c','Authorizations',['ViewAuthorizations']);
        $this->categories = AuthorizationCategory::all();
    }

    public function closeForm(){
        $this->categoryForm = false;
    }

    public function refreshCategories()
    {
        $this->categories = AuthorizationCategory::all();
        $this->categoryForm = false;
    }

    public function createCategory()
    {
        auth()->user()->allow('c','Authorizations',['CreateCategory']);
        $this->categoryId = 0;
        $this->categoryForm = true;
    }


    public function editCategory($id)
    {
        auth()->user()->allow('c','Rules',['EditCategory']);
        $this->categoryId = $id;
        $this->categoryForm = true;
    }

    public function ConfirmDeleteCategory($id)
    {
        auth()->user()->allow('c','Authorizations',['DeleteCategory']);
        $this->categoryId = $id;
        $this->showDelete = true;
    }

    public function deleteCategory()
    {
        $auth = AuthorizationCategory::find($this->categoryId);
        $message = "Deleted successfully'";
        $classes = "red rounded'";
        if (count($auth->rules) > 0){
            $message = 'Cannot delete';
        }else{
            $auth->delete();
        }
        $this->categories = AuthorizationCategory::all();
        $this->showDelete = false;
        $this->dispatchBrowserEvent('notify',[
            'message' => $message,
            'classes' => $classes
        ]);
    }
    public function render()
    {
        return view('livewire.user.authorization.index',[
            'categories' => $this->categories
        ]);
    }
}
