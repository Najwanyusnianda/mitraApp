<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use Livewire\WithPagination;
use App\User;

class UserIndex extends Component
{
    use WithPagination;

    public $name;
    public $email;
    public $password;
    public $role;
    public $is_active;

    public $user_id;

    
    protected $listeners=[
        'userCreated'=>'handleUserCreated',
        'userUpdated'=>'handleUserUpdated',
        'refreshComponent' => '$refresh'

    ];
    public function render()
    {
        $users=User::latest()->paginate(10);
        return view('livewire.user.user-index',
        ['users'=>$users]);
    }

    public function getUser($user_id){
        $user=User::find($user_id);
        $this->emit('getUser',$user);
    }

    public function handleUserCreated(){
        session()->flash('message','Pengguna berhasil ditambahkan');
    }

    public function handleUserUpdated(){
        session()->flash('info','Pengguna telah berhasil diperbarui');
    }

    public function confirmation($user_id){
        $this->user_id=$user_id;
        $this->dispatchBrowserEvent('showConfirmationModal');
    }

    public function deletePengguna($user_id){
        $this->dispatchBrowserEvent('closeConfirmationModal');
        $user=User::find($user_id);
        $user->delete();
        $this->emit('refreshComponent');
    }
}
