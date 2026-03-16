<?php

namespace App\Livewire\Users\Role;

use App\Models\Role;
use Livewire\Component;
use Livewire\WithPagination;

class RoleList extends Component
{
    use WithPagination;
    public $limit = 12;
    public $search;
    protected $queryString = ['apply', 'role_id'];
    public $apply;
    public $role_id;

    protected $listeners = ['refresh_role' => 'render'];

    public function render()
    {
        $this->apply = $this->apply;
        $this->role_id = $this->role_id;
        $roles = Role::where('id', '!=', 1)->orderBy('id', 'asc');
        if ($this->search) {
            $roles = $roles->where('name', 'ilike', $this->search.'%');
        }
        $roles = $roles->paginate($this->limit);

        return view('livewire.users.role.role-list', ['roles' => $roles])->title('Fiexd Assets - Roles');
    }

    public function showRoleCreateModal()
    {
        if (in_array('Create Role', session('user_permission')['Role'])) {
            $this->dispatch('modal.openModal');
        } else {
            $this->dispatch(
                'show-toast',
                type: 'warning',
                message: __("Access Denied! You don't have permission to access this function. Request access from your administrator")
            );
        }
    }

    public function openEditRoleModal($roleId)
    {
        if (in_array('Edit Role', session('user_permission')['Role'])) {
            $this->dispatch('edit_role', roleId: $roleId);
            $this->dispatch('modal.openUpdateModal');
        } else {
            $this->dispatch(
                'show-toast',
                type: 'warning',
                message: __("Access Denied! You don't have permission to access this function. Request access from your administrator")
            );
        }
    }

    public function apply_role_permission($role_id)
    {
        if (in_array('Set Permission', session('user_permission')['Role'])) {
            $this->redirect(route('role.apply_permission', ['role_id' => $role_id]), true);
        } else {
            $this->dispatch(
                'show-toast',
                type: 'warning',
                message: __("Access Denied! You don't have permission to access this function. Request access from your administrator")
            );
        }
    }
}
