<?php

namespace App\Http\Livewire\User;

use App\Http\Controllers\Helper;
use Livewire\Component;
use Livewire\WithFileUploads;

class Profile extends Component
{
    use WithFileUploads;

    public $profile;
    public $name;
    public $last_name;
    public $email;
    public $img;
    public $role;
    public $manager;
    public $password;
    public $password_confirmation;

    public function mount()
    {
        $this->img = auth()->user()->profile==null?asset('img/user.png'):asset('storage/'.auth()->user()->profile);
        $this->name = auth()->user()->name;
        $this->last_name = auth()->user()->last_name;
        $this->email = auth()->user()->email;
        $this->role = auth()->user()->id == 1?'Admin':auth()->user()->role->name;
        $this->manager = auth()->user()->user_id == 0?'I am manger':auth()->user()->manager()->name;
    }

    public function save()
    {
        if ($this->profile== null and $this->password==null){

            $this->dispatchBrowserEvent('notify',[
                'message' => 'Nothing found for update',
                'classes' => 'red rounded'
            ]);
        }else{
            if ($this->profile!=null){
                Helper::deleteFile(auth()->user()->profile);
                $this->validate([
                    'profile' => 'file|image|max:5000'
                ]);
                auth()->user()->update([
                    'profile' => $this->profile->store('users_profile','public')
                ]);
            }
            if ($this->password!=null){
                $this->validate([
                    'password' => 'min:8|same:password_confirmation'
                ]);
                auth()->user()->update([
                    'password' => \Hash::make($this->password)
                ]);
                $this->password = null;
                $this->password_confirmation = null;
            }
            $this->dispatchBrowserEvent('notify',[
                'message' => 'Updated successfully',
                'classes' => 'green rounded'
            ]);
        }
    }
    public function render()
    {
        return view('livewire.user.profile');
    }
}
