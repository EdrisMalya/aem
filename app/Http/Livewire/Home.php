<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;

class Home extends Component
{
    public $form=false;
    public $assignTask=false;
    public $users=[];
    protected $listeners = ['closeForm'];

    public function closeForm()
    {
        $this->form = false;
        $this->assignTask = false;
        $this->emit('refreshChildren');
    }
    public function mount()
    {
        if (auth()->user()->user_id==0){
            $this->users = User::where('user_id',auth()->id())->get();
        }
    }
    public function render()
    {
        return view('livewire.home');
    }
}
