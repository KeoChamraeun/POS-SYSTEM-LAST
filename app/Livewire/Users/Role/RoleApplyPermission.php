<?php

namespace App\Livewire\Users\Role;

use App\Models\Department;
use App\Models\Role;
use App\Models\RolePermission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class RoleApplyPermission extends Component
{
    public $get_departments;
    public $role_id;
    public $role;
    public $main_department = [];
    public $sub_department = [];
    public $sub_department_action = [];
    public $checked_department = [];

    public function handle_main_department($depart_id)
    {
        $department = Department::find($depart_id);
        foreach ($department->children as $item) {
            if ($this->main_department[$depart_id]) {
                $this->main_department[$depart_id] = $depart_id;
                $this->sub_department[$item->id] = true;
            } else {
                unset($this->sub_department[$item->id]);
                unset($this->sub_department_action[$item->id]);
            }

            foreach ($item->permission->pluck('id') as $action) {
                if ($this->main_department[$depart_id]) {
                    $this->sub_department_action[$item->id][$action] = true;
                } else {
                    unset($this->sub_department_action[$item->id][$action]);
                }
            }
        }
    }

    public function handle_sub_department($depart_id)
    {
        $department = Department::find($depart_id);
        if ($this->sub_department[$depart_id]) {
            foreach ($department->permission->pluck('id') as $key => $action) {
                $this->sub_department_action[$depart_id][$action] = true;
            }
        } else {
            unset($this->sub_department_action[$depart_id]);
        }
    }

    public $department_children = false;

    public function handle_sub_department_action($depart_id, $action_id)
    {
        if ($this->sub_department_action[$depart_id][$action_id]) {
        } else {
            unset($this->sub_department_action[$depart_id][$action_id]);
        }
    }

    public function mount()
    {
        $this->get_departments = Department::where('parent_id', null)->orderBy('sort', 'ASC')->get();
        $role = Role::find($this->role_id);
        $this->role = $role;
        foreach ($role->role_permission as $key => $item) {
            $this->sub_department[$item->department_id] = true;
            foreach (json_decode($item->permission, true) as $action) {
                $this->sub_department_action[$item->department_id][$action] = true;
            }
        }
    }

    public function remove_old_permmision()
    {
        DB::table('role_permissions')->where('role_id', $this->role_id)->delete();
    }

    public function setPermission()
    {
        $this->remove_old_permmision();
        foreach ($this->sub_department_action as $depart_id => $item) {
            $department = Department::find($depart_id);
            if ($department->parent) {
                array_push($this->main_department, $department->parent->id);
            }
            $newpermission = new RolePermission();
            $newpermission->department_id = $depart_id;
            $newpermission->role_id = $this->role_id;
            $newpermission->permission = json_encode(array_keys($item), JSON_UNESCAPED_UNICODE);
            $newpermission->save();
        }
        array_unique($this->main_department);
        foreach ($this->main_department as $key => $depart) {
            $newpermission = new RolePermission();
            $newpermission->department_id = $depart;
            $newpermission->role_id = $this->role_id;
            $newpermission->permission = json_encode([], JSON_UNESCAPED_UNICODE);
            $newpermission->save();
        }  create_transaction_log('Apply role', 'Apply role', $this->role->name.' has applied permission!', Auth::user()->name);
        $this->dispatch(
            'show-toast',
            type: 'success',
            message: $this->role->name.' '.__('has applied Permission!'),
        );
    }

    public function render()
    {
        return view('livewire.users.role.role-apply-permission');
    }
}
