<?php

namespace App\Livewire\Auth;

use App\Models\Department;
use App\Models\Permission;
use App\Models\RolePermission;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public $username;
    public $password;
    public $remember_me = false;

    protected $rules = [
        'username' => 'required|string|min:3',
        'password' => 'required|string|min:6',
    ];

    public function mount()
    {
        if (Auth::check()) {
            return redirect()->to('/');
        }
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.auth.login')
            ->layout('components.layouts.frontend')
            ->title('Login - '.config('app.name'));
    }

    public function doLogin()
    {
        $this->validate();

        $user = User::where('username', $this->username)->first();

        if (!$user || !Auth::attempt(['username' => $this->username, 'password' => $this->password], $this->remember_me)) {
            $this->sendAlert('error', 'Invalid credentials.');

            return;
        }

        if ($user->banned) {
            Auth::logout();
            $this->sendAlert('error', 'Your account has been banned. Please contact support.');

            return;
        }

        if (!$user->active) {
            Auth::logout();
            $this->sendAlert('error', 'Your account is inactive. Please contact support.');

            return;
        }
        $role_id = $user->role_id;
        if (!$role_id) {
            return $this->logoutWithError('Role not assigned. Contact administrator.');
        }

        $this->buildPermissions($role_id);
        create_transaction_log('Login', 'Auth', 'Login Success', $user->name);

        $this->sendAlert('success', 'Welcome, '.$user->name);

        return redirect()->route('dashboard');
    }

    private function buildPermissions(int $role_id)
    {
        $rolePermissions = RolePermission::where('role_id', $role_id)->get();
        $permissions = [];

        foreach ($rolePermissions as $rp) {
            $permIds = json_decode($rp->permission, true) ?? [];
            if (empty($permIds)) {
                continue;
            }

            $actions = Permission::whereIn('id', $permIds)->pluck('action')->toArray();
            $deptName = 'General';

            if (isset($rp->department_id)) {
                $dept = Department::find($rp->department_id);
                $deptName = $dept?->name ?? 'General';
            } else {
                $firstPerm = Permission::whereIn('id', $permIds)->first();
                $deptName = $firstPerm?->department?->name ?? 'General';
            }

            if (!isset($permissions[$deptName])) {
                $permissions[$deptName] = [];
            }

            $permissions[$deptName] = array_merge($permissions[$deptName], $actions);
        }

        foreach ($permissions as $dept => $actions) {
            $permissions[$dept] = array_unique($actions);
        }

        session(['user_permission' => $permissions]);
    }

    private function logoutWithError(string $message)
    {
        Auth::logout();
        $this->sendAlert('error', $message);
    }

    private function sendAlert(string $type, string $message)
    {
        $this->dispatch(
            'show-toast',
            type: $type,
            message: $message
        );
    }
}
