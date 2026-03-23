<?php

namespace App\Livewire\Users;

use App\Models\Branch;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class UserCreate extends Component
{
    use WithFileUploads;

    public $img;
    public $first;
    public $last;
    public $username;
    public $password;
    public $confirm_password;
    public $role_id;
    public $phone;
    public $branch_ids = [];
    public $default_branch_id;

    public $roles = [];
    public $branches = [];

    protected $listeners = ['openUserModal' => 'openModal'];

    protected $rules = [
        'first'             => 'required|string|min:2|max:100',
        'last'              => 'required|string|min:2|max:100',
        'username'          => 'required|string|min:4|max:50|unique:users,username',
        'password'          => 'required|string|min:6',
        'confirm_password'  => 'required|same:password',
        'role_id'           => 'required|exists:roles,id',
        'phone'             => 'nullable|string|max:20',
        'img'               => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'branch_ids'        => 'required|array|min:1',
        'branch_ids.*'      => 'exists:branches,id',
        'default_branch_id' => 'nullable|exists:branches,id',
    ];

    public function mount()
    {
        $this->roles    = Role::where('status', true)->whereNotIn('id', [1])->get();
        $this->branches = Branch::where('status', true)->orderBy('name')->get();
    }

    public function openModal()
    {
        $this->dispatch('show-add-user-modal');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function save()
    {
        $this->validate();

        $imagePath = null;
        if ($this->img) {
            $imagePath = $this->img->store('photos/profile', 'public');
        }

        try {
            $fullName = trim("{$this->first} {$this->last}");

            $user = User::create([
                'name'     => $fullName,
                'username' => $this->username,
                'password' => bcrypt($this->password),
                'role_id'  => $this->role_id,
                'phone'    => $this->phone,
                'profile'  => $imagePath,
                'active'   => true,
                'banned'   => false,
            ]);

            // Sync branches with pivot data
            $syncData = collect($this->branch_ids)->mapWithKeys(function ($branchId) {
                return [$branchId => [
                    'is_default' => $this->default_branch_id == $branchId,
                    'active'     => true,
                ]];
            })->toArray();

            $user->branches()->sync($syncData);

            // Optional logging
            // create_transaction_log('User Create', 'User', "{$this->username} ({$fullName}) created", Auth::user()->name);

            $this->dispatch('show-toast', type: 'success', message: __('User created successfully!'));
            $this->reset(['first', 'last', 'username', 'password', 'confirm_password', 'phone', 'role_id', 'img', 'branch_ids', 'default_branch_id']);
            $this->dispatch('close-add-user-modal');
            $this->dispatch('refresh_user');
        } catch (\Exception $e) {
            if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }

            $this->dispatch('show-toast', type: 'error', message: __('Failed to create user: ') . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.users.user-create');
    }
}