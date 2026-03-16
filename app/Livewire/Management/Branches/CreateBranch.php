<?php

namespace App\Livewire\Management\Branches;

use Livewire\Component;
use App\Models\Branch;

class CreateBranch extends Component
{
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
            'code'    => 'required|string|max:20|unique:branches,code',
            'phone'   => 'nullable|string|max:20',
            'email'   => 'nullable|email|max:120',
            'address' => 'nullable|string|max:500',
            'status'  => 'boolean',
        ];
    }

    public function open()
    {
        $this->reset();
        $this->resetValidation();
        $this->dispatch('open-create-branch-modal');
    }

    public function save()
    {
        $this->validate();

        Branch::create([
            'name'    => $this->name,
            'code'    => strtoupper(trim($this->code)),
            'phone'   => $this->phone,
            'email'   => $this->email,
            'address' => $this->address,
            'status'  => $this->status,
        ]);
        
        $this->dispatch('show-toast', type: 'success', message: __('Branch created successfully!'));

        $this->dispatch('close-create-branch-modal');
        $this->dispatch('refresh-branches');

        $this->reset();
    }

    public function render()
    {
        return view('livewire.management.branches.create-branch');
    }
}