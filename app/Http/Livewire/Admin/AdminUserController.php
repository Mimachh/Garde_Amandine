<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;

class AdminUserController extends Component
{
    public $users;
    public $state = [];
    public $updateMode = false;


    public function mount()
    {
        $this->users = User::all();
    }

    private function resetInputFields(){
        $this->reset('state');
    }

    public function edit($id)
    {
        $this->updateMode = true;

        $user = User::find($id);

        $this->state = [
            'id' => $user->id,
            'name' => $user->name,
            'role_id' => $user->role_id,
        ];
    }
    public function update()
    {
       
        if ($this->state['id']) {
            $user = User::find($this->state['id']);
            $user->update([
                'name' => $this->state['name'],
                'role_id' => $this->state['role_id'],
            ]);


            $this->updateMode = false;
            $this->reset('state');
            $this->users = User::all();
        }
    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->reset('state');
    }

    public function delete($user)
    {
        User::destroy($user);
        $this->users = User::all();
    }

    public function index()
    {

        return view('admin.users_list');
    }
    
    public function render()
    {
        return view('livewire.admin.admin-user-controller');
    }
}
