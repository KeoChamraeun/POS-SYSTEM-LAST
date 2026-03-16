<?php

namespace App\Livewire\Management\Customers;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Customer;

class CustomerList extends Component
{
    use WithPagination;

    public string $search = '';

    protected $listeners = [
        'refresh-customers' => '$refresh',
    ];

    public function openCreateCustomerModal()
    {
        $this->dispatch('open-create-customer');
    }

    public function editCustomer($customerId)
    {
        $this->dispatch('open-update-customer', customerId: $customerId);
    }

    public function render()
    {
        $customers = Customer::query()
            ->when($this->search, function ($q) {
                $q->where('name', 'like', "%{$this->search}%")
                  ->orWhere('code', 'like', "%{$this->search}%")
                  ->orWhere('phone', 'like', "%{$this->search}%")
                  ->orWhere('email', 'like', "%{$this->search}%");
            })
            ->latest()
            ->paginate(15);

        return view('livewire.management.customers.customer-list', [
            'customers' => $customers,
        ]);
    }
}