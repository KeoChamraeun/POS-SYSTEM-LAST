<?php

namespace App\Livewire\Users;

use App\Models\Branch;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class UserUpdate extends Component
{
    use WithFileUploads;

    public $userId;
    public $img;                // new file being uploaded
    public $imgStore;           // current stored path (for preview)

    public $first;
    public $last;
    public $username;
    public $phone;
    public $role_id;

    public $branch_ids = [];
    public $default_branch_id;

    public $roles = [];
    public $branches = [];

    protected $listeners = ['updateUser' => 'loadUser'];

    protected function rules()
    {
        return [
            'first'             => 'required|string|min:2|max:100',
            'last'              => 'required|string|min:2|max:100',
            'username'          => 'required|string|min:4|max:50|unique:users,username,' . $this->userId,
            'phone'             => 'nullable|string|max:20',
            'role_id'           => 'required|exists:roles,id',
            'img'               => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'branch_ids'        => 'required|array|min:1',
            'branch_ids.*'      => 'exists:branches,id',
            'default_branch_id' => [
                'nullable',
                'exists:branches,id',
                function ($attribute, $value, $fail) {
                    if (count($this->branch_ids) > 1 && empty($value)) {
                        $fail('Please select a default branch when multiple branches are assigned.');
                    }
                    if ($value && !in_array($value, $this->branch_ids)) {
                        $fail('Default branch must be one of the selected branches.');
                    }
                },
            ],
        ];
    }

    public function loadUser($id)
    {
        $user = User::with('branches')->findOrFail($id);

        $this->userId = $user->id;

        $nameParts = explode(' ', trim($user->name), 2);
        $this->first = $nameParts[0] ?? '';
        $this->last  = $nameParts[1] ?? '';

        $this->username = $user->username;
        $this->phone    = $user->phone;
        $this->role_id  = $user->role_id;
        $this->imgStore = $user->profile;

        // Load selected branches
        $this->branch_ids = $user->branches->pluck('id')->toArray();

        // Find current default branch
        $default = $user->branches()->wherePivot('is_default', true)->first();
        $this->default_branch_id = $default ? $default->id : null;

        $this->dispatch('openUpdateUser');
    }

    public function mount()
    {
        $this->roles    = Role::where('status', true)->whereNotIn('id', [1])->get();
        $this->branches = Branch::where('status', true)->orderBy('name')->get();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function update()
    {
        $this->validate();

        try {
            $user = User::findOrFail($this->userId);

            $fullName = trim("{$this->first} {$this->last}");

            $user->update([
                'name'     => $fullName,
                'username' => $this->username,
                'phone'    => $this->phone,
                'role_id'  => $this->role_id,
                'active'   => $user->active, // preserve existing
            ]);

            // Handle profile image
            if ($this->img) {
                if ($user->profile && Storage::disk('public')->exists($user->profile)) {
                    Storage::disk('public')->delete($user->profile);
                }
                $path = $this->img->store('photos/profile', 'public');
                $user->profile = $path;
                $user->save();
            }

            // Sync branches with pivot
            $syncData = collect($this->branch_ids)->mapWithKeys(function ($branchId) {
                return [$branchId => [
                    'is_default' => $this->default_branch_id == $branchId,
                    'active'     => true,
                ]];
            })->toArray();

            $user->branches()->sync($syncData);

            // Optional log
            // create_transaction_log('User Update', 'User', "{$this->username} ({$fullName}) updated", Auth::user()->name);

            $this->dispatch('show-toast', type: 'success', message: __('User updated successfully!'));
            $this->dispatch('closeUpdateUser');
            $this->dispatch('refresh_user');

        } catch (\Exception $e) {
            $this->dispatch('show-toast', type: 'error', message: __('Failed to update user: ') . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.users.user-update');
    }
}