<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use App\User;


class UserCreate extends Component
{
    public $name;
    public $email;
    public $password;
    public $role;
    public $is_active;

    public $user_id;
    public $seksi;

    protected $listeners=[
        'getUser'=>'handleUser',

    ];

    public function render()
    {
        $master_seksi=['sosial','ipds','produksi','distribusi','neraca'];
        return view('livewire.user.user-create',['master_seksi'=>$master_seksi]);
    }

    public function handleUser($user){
        $this->user_id=$user['id'];
        $this->name=$user['name'];
        $this->email=$user['email'];
       // $this->password=$user['password'];
        $this->role=$user['role'];
        $this->is_active=$user['is_active'];
        $this->seksi=$user['seksi'];
    }

    private function resetInput(){
        $this->name=null;
        $this->email=null;
        $this->password=null;
        $this->role=null;
        $this->is_active=null;
        $this->seksi=null;
    }

    public function store(){

        $user_check=User::where('email',$this->email)->first();
        if(empty($user_check)){
            $user=User::create([
                'name'=>$this->name,
                'email'=>$this->email,
                'password'=>Hash::make($this->password),
                'role'=>2,
                'is_active'=>1,
                'seksi'=>$this->seksi
            ]);
            $this->resetInput();
           $this->emit('userCreated');
            
        }else{
            $user_check->update([
                'name'=>$this->name,
                'email'=>$this->email,
                'password'=>Hash::make($this->password),
                'role'=>$this->role,
                'is_active'=>$this->is_active,
                'seksi'=>$this->seksi
            ]);
            $this->resetInput();
           $this->emit('userUpdated');
            
        }


    }

    public function update(){
        $user=User::find($this->user_id);

        $user->update([
            'name'=>$this->name,
            'email'=>$this->email,
            'password'=>Hash::make($this->password),
            'role'=>$this->role,
            'is_active'=>$this->is_active,
            'seksi'=>$this->seksi
        ]);
        $this->emit('userUpdated');
        $this->resetInput();
    }










}
