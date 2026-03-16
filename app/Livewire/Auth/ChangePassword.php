<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class ChangePassword extends Component
{
    public $oldPassword;
    public $newPassword;
    public $newPassword_confirmation;
    public $isMatch;

    public function render()
    {
        return view('livewire.auth.change-password');
    }

    public function checkPassword()
    {
        if (Hash::check($this->oldPassword, Auth::user()->password)) {
            $this->dispatch(
                'show-toast',
                type: 'success',
                message: __('The password matches.')
            );
            $this->isMatch = true;
        } else {
            $this->dispatch(
                'show-toast',
                type: 'error',
                message: __('The password is not matches.')
            );
            $this->isMatch = false;
        }
    }

    public function changePassword()
    {
        $this->validate(['newPassword' => 'required|min:6|confirmed']);
        if ($this->isMatch == true) {
            $auth = User::find(Auth::user()->id);
            $auth->password = $this->newPassword;
            create_transaction_log('Auth', 'Auth', $auth->name.' has been changed password!', Auth::user()->name);
            $auth->save();
            $this->reset();
            $this->dispatch(
                'show-toast',
                type: 'success',
                message: __('Password has been changed successfully!')
            );
            $this->dispatch('modal.closeModal');
        } else {
            $this->dispatch(
                'show-toast',
                type: 'error',
                message: __('Please confirm your old password first!')
            );
        }
    }
}
