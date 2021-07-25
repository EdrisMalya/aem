<?php

namespace App\Http\Livewire\User;

use App\Models\Role;
use App\Models\Rule;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;

class Form extends Component
{
    use WithFileUploads;

    public $profile;
    public $name;
    public $last_name;
    public $role_id;
    public $manager_id;
    public $email;
    public $password;
    public $confirm_password;
    public $roles = [];
    public $users = [];

    public function mount()
    {
        $this->roles = Role::all();
        $this->users = User::where('id','!=',auth()->id())->get();
    }

    public function save()
    {
        $this->validate(['profile'=>'required|file|image|max:5000']);
        $data  = $this->validate([
            'name' => 'required|string|min:3',
            'last_name' => 'required|string|min:3',
            'role_id' => 'required',
            'manager_id' => '',
            'email' => ['required','email',\Illuminate\Validation\Rule::unique('users')->ignore(auth()->id())],
            'password' => 'required|string|min:8',
        ]);
        $data['password'] = \Hash::make($data['password']);
        $data['user_id'] = $data['manager_id'];
        unset($data['manager_id']);
        $user = User::create($data);
        $user->update([
            'profile' => $this->profile->store('users_profile','public')
        ]);
        session()->flash('message','Created successfully');
        return redirect()->route('user.index');
    }

    public function render()
    {
        return view('livewire.user.form');
    }
}
