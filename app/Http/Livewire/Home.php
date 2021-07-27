<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class Home extends Component
{
    public $result;
    public function mount()
    {

    }
    public function render()
    {
        return view('livewire.home');
    }
}
