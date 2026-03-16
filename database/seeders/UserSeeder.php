<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\RolePermission;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data_roles = [
            [
                'name' => 'Master Admin',
                'abbreviation' => 'MA',
            ],
        ];
        $user = new User();
        $user->name = 'Keo Chamraeun';
        $user->username = 'RAEUN';
        $user->email = 'raeun@gmail.com';
        $user->phone = '012808272';
        $user->type = 'Master Admin';
        $user->password = bcrypt(123456);
        $user->role_id = 1;
        $user->banned = false;
        $user->active = true;
        $user->save();

        $permission_array = Permission::distinct()->orderBy('department_id', 'asc')->pluck('department_id');
        $staff = new Staff();
        $staff->role_id = 1;
        $staff->user_id = $user->id;
        $staff->save();
        foreach ($data_roles as $key => $item) {
            $role = new Role();
            $role->name = $item['name'];
            $role->abbreviation = $item['abbreviation'];
            $role->save();
            foreach ($permission_array as $key => $item) {
                $permission = Permission::where('department_id', $item)->pluck('id')->toArray();
                $role_permission = new RolePermission();
                $role_permission->role_id = $role->id;
                $role_permission->department_id = $item;
                $role_permission->permission = json_encode($permission, JSON_UNESCAPED_UNICODE);
                $role_permission->save();
            }
        }
    }
}
