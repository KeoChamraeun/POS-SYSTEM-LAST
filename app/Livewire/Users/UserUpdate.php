<?php

namespace App\Livewire\Users;

use App\Models\Company;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class UserUpdate extends Component
{
    use WithFileUploads;
    public $img;
    public $imgStore;
    public $roles;
    public $userId;
    public $first;
    public $last;
    public $companyId;
    public $companies;
    public $username;
    public $phone;
    public $role_id;
    protected $listeners = ['updateUser' => 'loadUser'];

    public function loadUser($id)
    {
        $user = User::find($id);
        $this->userId = $user->id;
        $nameParts = explode(' ', trim($user->name));
        $this->first = $nameParts[0] ?? '';
        $this->last = $nameParts[1] ?? '';
        $this->username = $user->username;
        $this->phone = $user->phone;
        $this->role_id = $user->role_id;
        $this->companyId = $user->company_id;
        $this->imgStore = $user->profile;
    }

    protected function rules()
    {
        return [
            'first' => 'required|string|max:255',
            'last' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,'.$this->userId,
            'role_id' => 'required|exists:roles,id',
            'img' => 'nullable|image|max:2048',
        ];
    }

    public function update()
    {
        $this->validate();
        try {
            $user = User::find($this->userId);
            $user->name = $this->first.' '.$this->last;
            $user->username = $this->username;
            $user->phone = $this->phone;
            $user->role_id = $this->role_id;
            $user->company_id = $this->companyId;
            if ($this->img) {
                if ($user->profile && Storage::disk('public')->exists($user->profile)) {
                    Storage::disk('public')->delete($user->profile);
                }

                $path = $this->img->store('photos', 'public');
                $user->profile = $path;
            }
            create_transaction_log('User Update', 'User', $this->username.' has updated successfully!', Auth::user()->name);
            $user->save();

            $this->dispatch(
                'show-toast',
                type: 'success',
                message: __('User updated successfully!')
            );

            $this->dispatch('closeUpdateUser');
            $this->dispatch('refresh_user');
        } catch (\Exception $e) {
            $this->dispatch(
                'show-toast',
                type: 'error',
                message: __('An error occurred while updating the user.')
            );
        }
    }

    public function render()
    {
        $this->roles = Role::whereNotIn('id', [1])->get();
        $this->companies = Company::all();

        return view('livewire.users.user-update');
    }
}
