<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Livewire\Component;

class Index extends Component
{
    public $users = [];
    public function mount()
    {
        if (!User::allow()){
            abort(401);
        }
        $this->users = User::where('id','!=',auth()->id())->get();
    }
    public function render()
    {
        return view('livewire.user.index');
    }
}
