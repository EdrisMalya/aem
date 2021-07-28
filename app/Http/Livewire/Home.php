<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;

class Home extends Component
{
    use WithFileUploads;
    public $result;
    public $description;
    public $files=[];
    public function mount()
    {

    }
    public function render()
    {
        return view('livewire.home');
    }
}
