<div class="container-fluid">
    <div class="row align-items-center g-3 mb-4">
        <div class="col-md-6">
            <h3 class="mb-0 fw-bold text-dark">
                <i class="fas fa-shopping-cart me-2 text-success"></i>
                Purchases
            </h3>
        </div>
        <div class="col-md-6 text-md-end">
            <button class="btn btn-success" wire:click="createNewPurchase">
                <i class="fas fa-plus me-2"></i> New Purchase
            </button>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-header">
            <input type="search" class="form-control w-50" placeholder="Search invoice, supplier..." 
                   wire:model.live.debounce.500ms="search">
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped mb-0 align-middle">
                    <thead class="table-light">
                        <tr>
                            <th class="text-center">#</th>
                            <th>Invoice No</th>
                            <th>Supplier</th>
                            <th>Date</th>
                            <th class="text-end">Total</th>
                            <th class="text-end">Paid</th>
                            <th class="text-end">Due</th>
                            <th>Payment</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($purchases as $index => $purchase)
                            <tr>
                                <td class="text-center">{{ $purchases->firstItem() + $index }}</td>
                                <td><strong>{{ $purchase->invoice_no }}</strong></td>
                                <td>{{ $purchase->supplier?->name ?? '—' }}</td>
                                <td>{{ $purchase->purchase_date?->format('d M Y') }}</td>
                                <td class="text-end">{{ number_format($purchase->total, 2) }}</td>
                                <td class="text-end">{{ number_format($purchase->paid_amount, 2) }}</td>
                                <td class="text-end fw-bold text-danger">{{ number_format($purchase->due_amount, 2) }}</td>
                                <td>
                                    @if($purchase->payment_status === 'paid')
                                        <span class="badge bg-success">Paid</span>
                                    @elseif($purchase->payment_status === 'partial')
                                        <span class="badge bg-warning">Partial</span>
                                    @else
                                        <span class="badge bg-danger">Due</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-primary" 
                                            wire:click="editPurchase({{ $purchase->id }})">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center py-5 text-muted">
                                    No purchases found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-footer d-flex justify-content-between align-items-center">
            {{ $purchases->links('vendor.pagination.bootstrap-5') }}
            <small class="text-muted">
                Showing {{ $purchases->count() }} of {{ $purchases->total() }}
            </small>
        </div>
    </div>

    <livewire:management.purchases.create-purchase />
    <livewire:management.purchases.update-purchase />
</div>