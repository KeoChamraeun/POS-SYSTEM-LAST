<?php

namespace App\Livewire\Users;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UpdateBanned extends Component
{
    protected $listeners = ['updateBanned' => 'getData'];
    public $userId;
    public $banned;

    public function getData($id)
    {
        $this->userId = $id;
        $user = User::find($id);
        $user->banned == true ? $this->banned = 1 : $this->banned = 0;
    }

    public function updateBanned()
    {
        $user = User::find($this->userId);
        $this->banned == 1 ? $user->banned = true : $user->banned = false;
        create_transaction_log('User Banned', 'User', $user->name.' has been '.($user->banned ? 'banned' : 'unbanned').' successfully!', Auth::user()->name);
        $user->save();
        $this->dispatch(
            'show-toast',
            type: 'success',
            message: __('User banned status has been updated successfully!')
        );
        $this->dispatch('closeUpdateBanned');
        $this->dispatch('refresh_user');
    }

    public function render()
    {
        return view('livewire.users.update-banned');
    }
}
