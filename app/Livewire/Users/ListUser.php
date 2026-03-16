<?php

namespace App\Livewire\Users;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class ListUser extends Component
{
    use WithPagination;

    protected $listeners = ['refresh_user' => 'render'];
    protected string $paginationTheme = 'bootstrap';

    public $limit = 10;
    public $search;

    public function render()
    {
        $users = User::whereNotIn('id', [1]);

        if ($this->search) {
            $users = $users->where(function ($query) {
                $query->where('name', 'ilike', '%' . $this->search . '%')
                    ->orWhere('username', 'ilike', '%' . $this->search . '%')
                    ->orWhere('phone', 'ilike', '%' . $this->search . '%');
            });
        }

        $users = $users->paginate($this->limit);

        return view('livewire.users.list-user', [
            'users' => $users
        ])->title('Fixed Assets | Users');
    }

    public function updateActive($id)
    {
        if (in_array('Update Active', session('user_permission')['User'])) {
            $this->dispatch('updateActive', id: $id);
            $this->dispatch('openUpdateActive');
        } else {
            $this->dispatch(
                'show-toast',
                type: 'warning',
                message: __("Access Denied! You don't have permission to access this function. Request access from your administrator")
            );
        }
    }

    public function updateUser($id)
    {
        if (in_array('Edit User', session('user_permission')['User'])) {
            $this->dispatch('updateUser', id: $id);
            $this->dispatch('openUpdateUser');
        } else {
            $this->dispatch(
                'show-toast',
                type: 'warning',
                message: __("Access Denied! You don't have permission to access this function. Request access from your administrator")
            );
        }
    }

    public function updateBanned($id)
    {
        if (in_array('Update Banned', session('user_permission')['User'])) {
            $this->dispatch('updateBanned', id: $id);
            $this->dispatch('openUpdateBanned');
        } else {
            $this->dispatch(
                'show-toast',
                type: 'warning',
                message: __("Access Denied! You don't have permission to access this function. Request access from your administrator")
            );
        }
    }

    public function restPasword($id)
    {
        if (in_array('Reset Password', session('user_permission')['User'])) {
            $this->dispatch('resetPassword', id: $id);
            $this->dispatch('openResetPasswordModal');
        } else {
            $this->dispatch(
                'show-toast',
                type: 'warning',
                message: __("Access Denied! You don't have permission to access this function. Request access from your administrator")
            );
        }
    }

    public function openUserModal()
    {
        if (in_array('Create User', session('user_permission')['User'])) {
            $this->dispatch('openUserModal');
        } else {
            $this->dispatch(
                'show-toast',
                type: 'warning',
                message: __("Access Denied! You don't have permission to access this function. Request access from your administrator")
            );
        }
    }
}