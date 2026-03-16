<?php

namespace App\Livewire\Users\Role;

use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class RoleUpdate extends Component
{
    public $role_id;
    public $name;
    public $description;
    public $role_status;
    public $readyToload = false;

    public function render()
    {
        return view('livewire.users.role.role-update');
    }
    public $listeners = ['edit_role', 'loadRoles'];
    protected $rules = [
        'name' => 'required',
    ];

    public function loadRoles()
    {
        $this->readyToload = true;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function edit_role($roleId)
    {
        $role = Role::find($roleId);
        $this->name = $role->name;
        $this->description = $role->description;
        $this->role_status = $role->status;
        $this->role_id = $roleId;
    }

    public function updateRole()
    {
        $this->validate();
        $role = Role::find($this->role_id);
        $role->name = $this->name;
        $role->description = $this->description;
        $role->status = $this->role_status;
        create_transaction_log('Role Update', 'Role', $this->name.' has updated successfully!', Auth::user()->name);
        $role->save();
        $this->dispatch(
            'show-toast',
            type: 'success',
            message: __('Role updated successfully!')
        );
        $this->dispatch('modal.closeModalUpdate');
        $this->dispatch('refresh_role');
    }
}
