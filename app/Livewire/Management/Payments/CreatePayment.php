<?php

namespace App\Livewire\Management\Payments;

use Livewire\Component;
use App\Models\Payment;
use App\Models\Branch;
use App\Models\Customer;
use App\Models\Supplier;
use App\Models\Sale;
use App\Models\Purchase;
use Illuminate\Support\Facades\Auth;

class CreatePayment extends Component
{
    public $branches   = [];
    public $customers  = [];
    public $suppliers  = [];
    public $sales      = [];
    public $purchases  = [];

    public $branch_id       = '';
    public $payment_type    = 'other'; // sale, purchase, customer, supplier, other
    public $sale_id         = null;
    public $purchase_id     = null;
    public $customer_id     = null;
    public $supplier_id     = null;
    public $payment_date    = '';
    public $amount          = '';
    public $payment_method  = 'cash';
    public $reference_no    = '';
    public $note            = '';

    protected $rules = [
        'branch_id'         => 'required|exists:branches,id',
        'payment_date'      => 'required|date',
        'amount'            => 'required|numeric|min:0.01',
        'payment_method'    => 'required|in:cash,card,aba,acleda,wing,bank',
        'reference_no'      => 'nullable|string|max:100',
        'note'              => 'nullable|string|max:1500',
        'sale_id'           => 'required_if:payment_type,sale|nullable|exists:sales,id',
        'purchase_id'       => 'required_if:payment_type,purchase|nullable|exists:purchases,id',
        'customer_id'       => 'required_if:payment_type,customer|nullable|exists:customers,id',
        'supplier_id'       => 'required_if:payment_type,supplier|nullable|exists:suppliers,id',
    ];

    public function mount()
    {
        $this->branches   = Branch::where('status', true)->get(['id', 'name']);
        $this->customers  = Customer::where('status', true)->get(['id', 'name']);
        $this->suppliers  = Supplier::where('status', true)->get(['id', 'name']);
        $this->sales      = Sale::latest()->take(50)->get(['id', 'invoice_no']);
        $this->purchases  = Purchase::latest()->take(50)->get(['id', 'invoice_no']);

        $this->payment_date = now()->format('Y-m-d\TH:i');
    }

    public function updatedPaymentType()
    {
        $this->sale_id      = null;
        $this->purchase_id  = null;
        $this->customer_id  = null;
        $this->supplier_id  = null;
    }

    public function save()
    {
        $this->validate();

        Payment::create([
            'branch_id'       => $this->branch_id,
            'sale_id'         => $this->sale_id,
            'purchase_id'     => $this->purchase_id,
            'customer_id'     => $this->customer_id,
            'supplier_id'     => $this->supplier_id,
            'payment_date'    => $this->payment_date,
            'amount'          => $this->amount,
            'payment_method'  => $this->payment_method,
            'reference_no'    => trim($this->reference_no) ?: null,
            'note'            => trim($this->note) ?: null,
            'created_by'      => Auth::id(),
        ]);

        $this->dispatch('show-toast', type: 'success', message: 'Payment recorded successfully');
        $this->dispatch('close-create-payment');
        $this->dispatch('refresh-payments');

        $this->resetForm();
    }

    public function resetForm()
    {
        $this->branch_id       = '';
        $this->payment_type    = 'other';
        $this->sale_id         = null;
        $this->purchase_id     = null;
        $this->customer_id     = null;
        $this->supplier_id     = null;
        $this->payment_date    = now()->format('Y-m-d\TH:i');
        $this->amount          = '';
        $this->payment_method  = 'cash';
        $this->reference_no    = '';
        $this->note            = '';
    }

    public function render()
    {
        return view('livewire.management.payments.create-payment');
    }
}