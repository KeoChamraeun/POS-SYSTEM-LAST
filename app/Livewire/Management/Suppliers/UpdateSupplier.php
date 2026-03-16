<?php

namespace App\Livewire\Management\Suppliers;

use Livewire\Attributes\On;
use Livewire\Component;
use App\Models\Supplier;

class UpdateSupplier extends Component
{
    public ?int $supplierId = null;

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

    #[On('open-update-supplier')]
    public function loadSupplier($supplierId)
    {
        $this->supplierId = $supplierId;

        $supplier = Supplier::findOrFail($this->supplierId);

        $this->fill([
            'name'         => $supplier->name,
            'company_name' => $supplier->company_name ?? '',
            'phone'        => $supplier->phone ?? '',
            'email'        => $supplier->email ?? '',
            'address'      => $supplier->address ?? '',
            'note'         => $supplier->note ?? '',
            'status'       => $supplier->status,
        ]);

        $this->resetValidation();
        $this->dispatch('open-update-supplier-modal');
    }

    public function update()
    {
        $this->validate();

        $supplier = Supplier::findOrFail($this->supplierId);

        $supplier->update([
            'name'         => trim($this->name),
            'company_name' => trim($this->company_name) ?: null,
            'phone'        => trim($this->phone) ?: null,
            'email'        => trim($this->email) ?: null,
            'address'      => trim($this->address) ?: null,
            'note'         => trim($this->note) ?: null,
            'status'       => $this->status,
        ]);

        $this->dispatch('show-toast', type: 'success', message: __('Supplier updated successfully'));
        $this->dispatch('close-update-supplier-modal');
        $this->dispatch('refresh-suppliers');

        $this->reset();
        $this->supplierId = null;
    }

    public function render()
    {
        return view('livewire.management.suppliers.update-supplier');
    }
}