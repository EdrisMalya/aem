<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Livewire\Component;

class Index extends Component
{
    public $users = [];
    public $showDelete = false;
    public $user_id;

    public function deleteForm($id)
    {
        $this->showDelete = true;
        $this->user_id = $id;
    }
    public function delete()
    {
        auth()->user()->allow('d','Users',['DeleteUser']);
        User::find($this->user_id)->delete();
        session()->flash('message','Deleted successfully');
        return redirect()->to(route('user.index'));
    }
    public function mount()
    {
        auth()->user()->allow('c','Users',['ViewUsers']);
        $this->users = User::where('id','!=',auth()->id())->get();
    }
    public function render()
    {
        return view('livewire.user.index');
    }
}
