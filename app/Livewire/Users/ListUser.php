<?php

namespace App\Livewire\Users;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
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
        $currentUser = Auth::user();

        $query = User::whereNotIn('id', [1]) // exclude super admin if needed
                     ->where('id', '!=', $currentUser->id); // optional: hide self

        // Branch scoping for non-super-admins
        if ($currentUser->role_id != 1) {
            $branchIds = $currentUser->branches()->pluck('branches.id')->toArray();

            if (empty($branchIds)) {
                // User belongs to no branches → can't see anyone
                $query->where('id', 0); // impossible condition
            } else {
                $query->whereHas('branches', fn($q) => $q->whereIn('branches.id', $branchIds));
            }
        }

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('name', 'ilike', "%{$this->search}%")
                  ->orWhere('username', 'ilike', "%{$this->search}%")
                  ->orWhere('phone', 'ilike', "%{$this->search}%");
            });
        }

        $users = $query->with(['role', 'branches'])
                       ->latest()
                       ->paginate($this->limit);

        return view('livewire.users.list-user', compact('users'))
               ->title('Fixed Assets | Users');
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