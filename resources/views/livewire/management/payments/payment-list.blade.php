<div class="container-fluid">
    <div class="row align-items-center g-3 mb-4">
        <div class="col-md-6">
            <h3 class="mb-0 fw-bold text-dark">
                <i class="fas fa-money-bill-wave me-2 text-primary"></i>
                Payments
            </h3>
        </div>
        <div class="col-md-6 text-md-end">
            <button type="button" class="btn btn-primary" wire:click="openCreatePayment">
                <i class="fas fa-plus me-2"></i> New Payment
            </button>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-header">
            <input type="search" class="form-control w-50" placeholder="Search reference, customer, supplier..."
                   wire:model.live.debounce.400ms="search">
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="text-center">#</th>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Method</th>
                            <th>Reference</th>
                            <th>Customer / Supplier</th>
                            <th>Related To</th>
                            <th>Branch</th>
                            <th>Created By</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($payments as $index => $payment)
                            <tr>
                                <td class="text-center">{{ $payments->firstItem() + $index }}</td>
                                <td>{{ $payment->payment_date->format('d M Y H:i') }}</td>
                                <td class="text-end fw-bold">{{ number_format($payment->amount, 2) }}</td>
                                <td>
                                    <span class="badge bg-info">{{ ucfirst($payment->payment_method) }}</span>
                                </td>
                                <td>{{ $payment->reference_no ?: '—' }}</td>
                                <td>
                                    @if($payment->customer_id)
                                        {{ $payment->customer?->name ?? 'Customer #' . $payment->customer_id }}
                                    @elseif($payment->supplier_id)
                                        {{ $payment->supplier?->name ?? 'Supplier #' . $payment->supplier_id }}
                                    @else
                                        —
                                    @endif
                                </td>
                                <td>
                                    @if($payment->sale_id) Sale #{{ $payment->sale_id }}
                                    @elseif($payment->purchase_id) Purchase #{{ $payment->purchase_id }}
                                    @else —
                                    @endif
                                </td>
                                <td>{{ $payment->branch?->name ?? '—' }}</td>
                                <td>{{ $payment->creator?->name ?? '—' }}</td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-primary"
                                            wire:click="editPayment({{ $payment->id }})">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="text-center py-5 text-muted">
                                    No payments found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-footer d-flex justify-content-between align-items-center">
            {{ $payments->links('vendor.pagination.bootstrap-5') }}
            <small class="text-muted">
                Showing {{ $payments->count() }} of {{ $payments->total() }}
            </small>
        </div>
    </div>

    <livewire:management.payments.create-payment />
    <livewire:management.payments.update-payment />
</div>