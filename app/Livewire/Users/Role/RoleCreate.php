<?php

namespace App\Livewire\Users\Role;

use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class RoleCreate extends Component
{
    public $name;
    public $description;
    public $role_status = 1;

    public function render()
    {
        return view('livewire.users.role.role-create');
    }
    protected $rules = [
        'name' => 'required',
        'role_status' => 'required',
    ];

    public function messages()
    {
        return [
            'name.required' => 'The role field is required.',
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function createRole()
    {
        $this->validate();
        $errors = $this->getErrorBag();
        if (check_role_name_exist('name', $this->name)) {
            $errors->add('name', 'The '.$this->name.' already exist');
        }
        if (count($errors)) {
            return $errors;
        }
        $role = new Role();
        $role->name = $this->name;
        $role->description = $this->description;
        $role->status = $this->role_status;
        create_transaction_log('Role Create', 'Role', $this->name.' has created successfully!', Auth::user()->name);
        $role->save();
        $this->dispatch(
            'show-toast',
            type: 'success',
            message: __('Role created successfully!')
        );
        $this->reset();
        $this->dispatch('modal.closeModal');
        $this->dispatch('refresh_role');
    }
}
