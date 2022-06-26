<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class AssingTask extends Component
{
    public $users;
    public $user_id=0;

    public function mount()
    {
        $this->users = User::where('user_id','=',auth()->id())->get();
    }
    public function closeForm()
    {
        $this->emitUp('closeForm');
    }
    public function render()
    {
        return view('livewire.assing-task');
    }
}
