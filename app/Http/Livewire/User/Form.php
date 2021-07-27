<?php

namespace App\Http\Livewire\User;

use App\Models\Role;
use App\Models\Rule;
use App\Models\User;
use Illuminate\Support\Facades\File;
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
    public $user;
    public $img = null;

    public function mount(User $user)
    {
        auth()->user()->allow('c','Users',['CreateUser']);
        $this->user = $user;
        $this->roles = Role::all();
        $this->users = User::all();
        if ($user){
            $this->img = $user->profile!=null?asset('storage/'.$user->profile):asset('img/user.png');
            $this->name = $user->name;
            $this->last_name = $user->last_name;
            $this->role_id = $user->role_id;
            $this->manager_id = $user->user_id;
            $this->email = $user->email;
        }
    }

    public function save()
    {
        $data  = $this->validate([
            'name' => 'required|string|min:3',
            'last_name' => 'required|string|min:3',
            'role_id' => 'required',
            'manager_id' => '',
            'email' => ['required','email',\Illuminate\Validation\Rule::unique('users')->ignore($this->user->id)],
            'password' => ''
        ]);
        $data['password'] = \Hash::make($data['password']);
        $data['user_id'] = $data['manager_id'];
        unset($data['manager_id']);
        $message = null;
        if ($this->user->email!=null){
            unset($data['password']);
            $this->user->update($data);
            if (!empty($this->password)){
                if ($this->password===$this->confirm_password){
                    $this->user->update([
                        'password' => \Hash::make($this->password)
                    ]);
                }else{
                    $this->dispatchBrowserEvent('notify',[
                        'message' => 'Password not updated because it does not with confirmation password',
                        'classes' => 'red rounded'
                    ]);
                }
            }
            if (!empty($this->profile)){
                if (File::exists(asset('storage/'.$this->user->profile))){
                    $this->validate(['profile'=>'required|file|image|max:5000']);
                    File::delete(asset('storage/'.$this->user->profile));
                }
                $this->user->update([
                    'profile' => $this->profile->store('users_profile','public')
                ]);
            }
            $this->dispatchBrowserEvent('notify',[
                'message' => 'Updated successfully',
                'classes' => 'green rounded'
            ]);
        }else{
            $this->validate(['profile'=>'required|file|image|max:5000']);
            $data['password'] = $this->validate(['password' => 'required|string|min:8',
            ])['password'];
            $user = User::create($data);
            $user->update([
                'profile' => $this->profile->store('users_profile','public')
            ]);
            session()->flash('message','Created successfully');
            return redirect()->route('user.index');
        }
    }

    public function render()
    {
        return view('livewire.user.form');
    }
}
