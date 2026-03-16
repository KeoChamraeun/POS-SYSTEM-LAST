<?php

namespace App\Livewire\Management\Customers;

use Livewire\Component;
use App\Models\Customer;

class CreateCustomer extends Component
{
    public string $name = '';
    public string $phone = '';
    public string $email = '';
    public string $address = '';
    public ?string $gender = null;
    public ?string $dob = null;
    public string $note = '';
    public bool $status = true;

    protected function rules(): array
    {
        return [
            'name'    => 'required|string|max:120',
            'phone'   => 'nullable|string|max:20',
            'email'   => 'nullable|email|max:100',
            'address' => 'nullable|string|max:500',
            'gender'  => 'nullable|in:male,female,other',
            'dob'     => 'nullable|date',
            'note'    => 'nullable|string|max:1000',
            'status'  => 'boolean',
        ];
    }

    public function save()
    {
        $this->validate();

        Customer::create([
            'code'    => Customer::generateCode(),
            'name'    => trim($this->name),
            'phone'   => trim($this->phone) ?: null,
            'email'   => trim($this->email) ?: null,
            'address' => trim($this->address) ?: null,
            'gender'  => $this->gender,
            'dob'     => $this->dob ?: null,
            'note'    => trim($this->note) ?: null,
            'status'  => $this->status,
        ]);

        $this->dispatch('show-toast', type: 'success', message: __('Customer created successfully'));
        $this->dispatch('close-create-customer');
        $this->dispatch('refresh-customers');

        $this->reset();
    }

    public function render()
    {
        return view('livewire.management.customers.create-customer');
    }
}