<?php

namespace App\Livewire\Users;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ResetPassword extends Component
{
    public $user_id;
    public $password;
    public $confirm_password;
    protected $listeners = ['resetPassword' => 'openModal'];

    public function render()
    {
        return view('livewire.users.reset-password');
    }

    public function openModal($id)
    {
        $this->user_id = $id;
    }

    public function resetPassword()
    {
        $this->validate([
            'password' => 'required|string|min:6',
            'confirm_password' => 'required|same:password',
        ]);

        $user = User::find($this->user_id);

        if (!$user) {
            $this->dispatch('show-toast', type: 'error', message: __('User not found.'));

            return;
        }

        $user->password = bcrypt($this->password);
        create_transaction_log('Reset Password', 'User', $user->username.' has reset password successfully!', Auth::user()->name);
        $user->save();

        $this->dispatch('show-toast', type: 'success', message: __('Password has been reset successfully.'));
        $this->dispatch('closeResetPasswordModal');
        $this->reset(['password', 'confirm_password']);
    }
}
