<?php

namespace App\Livewire\Management\Suppliers;

use Livewire\Component;
use App\Models\Supplier;

class CreateSupplier extends Component
{
    public string $name = '';
    public string $company_name = '';
    public string $phone = '';
    public string $email = '';
    public string $address = '';
    public string $note = '';
    public bool $status = true;

    protected function rules(): array
    {
        return [
            'name'          => 'required|string|max:120',
            'company_name'  => 'nullable|string|max:150',
            'phone'         => 'nullable|string|max:25',
            'email'         => 'nullable|email|max:100',
            'address'       => 'nullable|string|max:500',
            'note'          => 'nullable|string|max:1500',
            'status'        => 'boolean',
        ];
    }

    public function save()
    {
        $this->validate();

        Supplier::create([
            'code'         => Supplier::generateCode(),
            'name'         => trim($this->name),
            'company_name' => trim($this->company_name) ?: null,
            'phone'        => trim($this->phone) ?: null,
            'email'        => trim($this->email) ?: null,
            'address'      => trim($this->address) ?: null,
            'note'         => trim($this->note) ?: null,
            'status'       => $this->status,
        ]);

        $this->dispatch('show-toast', type: 'success', message: __('Supplier created successfully'));
        $this->dispatch('close-create-supplier');
        $this->dispatch('refresh-suppliers');

        $this->reset();
    }

    public function render()
    {
        return view('livewire.management.suppliers.create-supplier');
    }
}