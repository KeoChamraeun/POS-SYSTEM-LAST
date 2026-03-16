<?php

namespace App\Livewire\Users;

use App\Models\Company;
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
    public $roles;
    public $company_id;
    public $phone;
    protected $listeners = ['openUserModal' => 'openModal'];

    public function openModal()
    {
        $this->dispatch('show-add-user-modal');
    }

    protected $rules = [
        'first' => 'required|string|max:255',
        'last' => 'required|string|max:255',
        'username' => 'required|string|max:255|unique:users,username',
        'password' => 'required|string|min:6',
        'confirm_password' => 'required|same:password',
        'role_id' => 'required|exists:roles,id',
        'img' => 'nullable|image|max:2048',
    ];

    public function render()
    {
        $this->roles = Role::where('status', 'true')
            ->whereNotIn('id', [1])
            ->get();

        return view('livewire.users.user-create');
    }

    public function save()
    {
        $this->validate();

        $imagePath = null;

        try {
            if ($this->img) {
                $imagePath = $this->img->store('photos', 'public');
            }
            $user = new User();
            $user->name = $this->first.' '.$this->last;
            $user->username = $this->username;
            $user->password = bcrypt($this->password);
            $user->role_id = $this->role_id;
            $user->phone = $this->phone;
            $user->profile = $imagePath;
            $user->company_id = $this->company_id;
            create_transaction_log('User Create', 'User', $this->username.' has created successfully!', Auth::user()->name);
            $user->save();
            $this->dispatch(
                'show-toast',
                type: 'success',
                message: __('User created successfully!')
            );
            $this->reset();
            $this->dispatch('close-add-user-modal');
            $this->dispatch('refresh_user');
        } catch (\Throwable $e) {
            if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }

            $msg = 'Failed to add user: '.$e->getMessage();
            dd($msg);
            $this->dispatch('show-toast', type: 'error', message: $msg);
        }
    }
}
