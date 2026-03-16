<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jsonDepartment = [
            [
                'name' => 'Dashboard',
                'slug' => '/',
                'type' => 'dashboard',
                'language' => ['lang' => 'kh', 'name' => 'ផ្ទាំងគ្រប់គ្រង'],
                'description' => 'Dashboard master admin',
                'status' => true,
                'icon' => '<i class="bi bi-grid"></i>',
                'actions' => ['Vew'],
                'children' => [],
            ],
            [
                'name' => 'User Management',
                'slug' => '/user',
                'type' => 'list',
                'language' => ['lang' => 'kh', 'name' => 'គណនីអ្នកប្រើប្រាស់'],
                'description' => 'User management progress',
                'status' => true,
                'icon' => '<i class="fas fa-users-cog menu-icon"></i>',
                'actions' => ['User', 'Role'],
                'children' => [
                    [
                        'name' => 'User',
                        'slug' => '/user/list',
                        'type' => '',
                        'language' => ['lang' => 'kh', 'name' => 'អ្នកប្រើ'],
                        'description' => 'user management',
                        'status' => true,
                        'type' => 'menu',
                        'icon' => '<svg width="15px" height="17px" viewBox="0 0 18 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9 0.5C4.032 0.5 0 4.532 0 9.5C0 14.468 4.032 18.5 9 18.5C13.968 18.5 18 14.468 18 9.5C18 4.532 13.968 0.5 9 0.5ZM12.249 6.206C13.212 6.206 13.986 6.98 13.986 7.943C13.986 8.906 13.212 9.68 12.249 9.68C11.286 9.68 10.512 8.906 10.512 7.943C10.503 6.98 11.286 6.206 12.249 6.206ZM6.849 4.784C8.019 4.784 8.973 5.738 8.973 6.908C8.973 8.078 8.019 9.032 6.849 9.032C5.679 9.032 4.725 8.078 4.725 6.908C4.725 5.729 5.67 4.784 6.849 4.784ZM6.849 13.001V16.376C4.689 15.701 2.979 14.036 2.223 11.912C3.168 10.904 5.526 10.391 6.849 10.391C7.326 10.391 7.929 10.463 8.559 10.589C7.083 11.372 6.849 12.407 6.849 13.001ZM9 16.7C8.757 16.7 8.523 16.691 8.289 16.664V13.001C8.289 11.723 10.935 11.084 12.249 11.084C13.212 11.084 14.877 11.435 15.705 12.119C14.652 14.792 12.051 16.7 9 16.7Z" fill="currentColor"/>
                            </svg>',
                        'actions' => ['Create User', 'Edit User', 'Reset Password', 'Change Password', 'Change Role', 'View Profile', 'Update Active', 'Update Banned', 'Delete User'],
                        'children' => [],
                    ],

                    [
                        'name' => 'Role',
                        'slug' => '/user/role',
                        'type' => '',
                        'language' => ['lang' => 'kh', 'name' => 'សិទ្ធិប្រើប្រាស់'],
                        'description' => 'user management and apply role & permission',
                        'status' => true,
                        'type' => 'menu',
                        'icon' => '<svg width="15px" height="17px" viewBox="0 0 13 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10.0489 6.28202C10.2929 6.28202 10.5298 6.31073 10.7667 6.34662V2.88693L5.38333 0.539795L0 2.88693V6.41122C0 9.66993 2.29689 12.7205 5.38333 13.4598C5.77811 13.3665 6.15854 13.2301 6.53178 13.065C6.03651 12.3616 5.74222 11.5074 5.74222 10.5887C5.74222 8.21284 7.67305 6.28202 10.0489 6.28202Z" fill="currentColor"/>
                                <path d="M10.0503 7.71802C8.46402 7.71802 7.1792 9.00284 7.1792 10.5891C7.1792 12.1754 8.46402 13.4602 10.0503 13.4602C11.6366 13.4602 12.9214 12.1754 12.9214 10.5891C12.9214 9.00284 11.6366 7.71802 10.0503 7.71802ZM10.0503 8.70855C10.4953 8.70855 10.8542 9.07462 10.8542 9.51246C10.8542 9.95031 10.4882 10.3164 10.0503 10.3164C9.61247 10.3164 9.2464 9.95031 9.2464 9.51246C9.2464 9.07462 9.60529 8.70855 10.0503 8.70855ZM10.0503 12.563C9.38278 12.563 8.80138 12.2328 8.44249 11.7232C8.47838 11.2064 9.52633 10.948 10.0503 10.948C10.5743 10.948 11.6222 11.2064 11.6581 11.7232C11.2992 12.2328 10.7178 12.563 10.0503 12.563Z" fill="currentColor"/>
                            </svg>',
                        'actions' => ['Create Role', 'Edit Role', 'Set Permission', 'Delete Role'],
                        'children' => [],
                    ],
                ],
            ],
            [
                'name' => 'Other Management',
                'slug' => '/manage',
                'type' => 'list',
                'language' => ['lang' => 'kh', 'name' => 'គ្រប់គ្រងផ្សេងៗ'],
                'description' => 'Other management',
                'status' => true,
                'icon' => '<i class="iconoir-view-grid menu-icon"></i>',
                'actions' => ['Staffs', 'Company', 'Department', 'Position', 'Brand', 'Item Inventory'],
                'children' => [
                ],
            ],
            [
                'name' => 'Report',
                'slug' => '/report',
                'type' => 'loan',
                'language' => ['lang' => 'kh', 'name' => 'របាយណ៍ការណ៍'],
                'description' => 'reporting for management export ',
                'status' => true,
                'icon' => '<i class="far fa-file-alt menu-icon"></i>',
                'actions' => ['Summary of Fixed Assets Depreciation', 'Consolidate of Fixed Assets', 'Purchase of Expendable', 'Tax Law Depreciation Expense Report'],
                'children' => [

                ],
            ],
            [
                'name' => 'Setting',
                'slug' => '/setting',
                'type' => '',
                'language' => ['lang' => 'kh', 'name' => 'ការកំណត់ផ្សេងៗ'],
                'description' => 'reporting for management export ',
                'status' => true,
                'icon' => '<i class="fas fa-cog menu-icon"></i>',
                'actions' => ['Languages', 'Exchange Rage', 'System Logs'],
                'children' => [], // <-- removed children
            ],
        ];

        foreach ($jsonDepartment as $i => $item) {
            $parent = DB::table('departments')->insertGetId([
                'name' => $item['name'],
                'slug' => $item['slug'],
                'type' => $item['type'],
                'icon' => $item['icon'],
                'languages' => json_encode($item['language'], JSON_UNESCAPED_UNICODE),
                'description' => $item['description'],
                'status' => $item['status'],
                'sort' => $i,
            ]);
            foreach ($item['actions'] as $item_key => $action) {
                DB::table('permissions')->insert([
                    'sort' => $item_key,
                    'action' => $action,
                    'scope' => $parent,
                    'department_id' => $parent,
                ]);
            }

            foreach ($item['children'] as $index => $children_sub) {
                $childrenGetId = DB::table('departments')->insertGetId([
                    'name' => $children_sub['name'],
                    'slug' => $children_sub['slug'],
                    'icon' => $children_sub['icon'],
                    'languages' => json_encode($children_sub['language'], JSON_UNESCAPED_UNICODE),
                    'description' => $children_sub['description'],
                    'status' => $children_sub['status'],
                    'sort' => $index,
                    'type' => $children_sub['type'],
                    'parent_id' => $parent,
                ]);
                foreach ($children_sub['actions'] as $child_key => $action_child) {
                    DB::table('permissions')->insert([
                        'sort' => $child_key,
                        'action' => $action_child,
                        'scope' => $childrenGetId,
                        'department_id' => $childrenGetId,
                    ]);
                }
            }
        }
    }
}
