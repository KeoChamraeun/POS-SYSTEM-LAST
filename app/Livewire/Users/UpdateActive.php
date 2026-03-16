<?php

namespace App\Livewire\Users;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UpdateActive extends Component
{
    protected $listeners = ['updateActive' => 'getData'];
    public $userId;
    public $active;

    public function getData($id)
    {
        $this->userId = $id;
        $user = User::find($id);
        $user->active == true ? $this->active = 1 : $this->active = 0;
    }

    public function updateActive()
    {
        $user = User::find($this->userId);
        $this->active == 1 ? $user->active = true : $user->active = false;
        create_transaction_log('User Active', 'User', $user->name.' has been '.($user->active ? 'activated' : 'deactivated').' successfully!', Auth::user()->name);
        $user->save();
        $this->dispatch(
            'show-toast',
            type: 'success',
            message: __('User active status has been updated successfully!')
        );
        $this->dispatch('closeUpdateActive');
        $this->dispatch('refresh_user');
    }

    public function render()
    {
        return view('livewire.users.update-active');
    }
}
