<?php

namespace App\Livewire\Management\Branches;

use Livewire\Attributes\On;
use Livewire\Component;
use App\Models\Branch;

class UpdateBranch extends Component
{
    public ?int $branchId = null;

    public string $name = '';
    public string $code = '';
    public string $phone = '';
    public string $email = '';
    public string $address = '';
    public bool $status = true;

    protected function rules(): array
    {
        return [
            'name'    => 'required|string|max:120',
            'code'    => 'required|string|max:20|unique:branches,code,' . ($this->branchId ?? 'NULL'),
            'phone'   => 'nullable|string|max:20',
            'email'   => 'nullable|email|max:120',
            'address' => 'nullable|string|max:500',
            'status'  => 'boolean',
        ];
    }

    #[On('open-update-branch-modal')]
    public function prepareEdit($branchId)
    {
        $this->branchId = (int) $branchId;

        if (!$this->branchId) {
            $this->dispatch('show-toast', type: 'warning', message: 'Invalid branch ID');
            return;
        }

        $branch = Branch::findOrFail($this->branchId);

        $this->fill([
            'name'    => $branch->name,
            'code'    => $branch->code,
            'phone'   => $branch->phone ?? '',
            'email'   => $branch->email ?? '',
            'address' => $branch->address ?? '',
            'status'  => $branch->status,
        ]);

        $this->resetValidation();

        $this->dispatch('show-update-modal');
    }

    public function update()
    {
        $this->validate();

        $branch = Branch::findOrFail($this->branchId);

        $branch->update([
            'name'    => $this->name,
            'code'    => strtoupper(trim($this->code)),
            'phone'   => $this->phone ?: null,
            'email'   => $this->email ?: null,
            'address' => $this->address ?: null,
            'status'  => $this->status,
        ]);

        $this->dispatch('show-toast', type: 'success', message: __('Branch updated successfully!'));

        $this->dispatch('close-update-modal');
        $this->dispatch('refresh-branches');

        $this->reset(['name', 'code', 'phone', 'email', 'address', 'status', 'branchId']);
    }

    public function render()
    {
        return view('livewire.management.branches.update-branch');
    }
}