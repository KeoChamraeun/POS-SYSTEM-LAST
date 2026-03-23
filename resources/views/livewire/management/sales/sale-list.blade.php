<div class="container-fluid">
    <div class="row align-items-center g-3 mb-4">
        <div class="col-md-6">
            <h3 class="mb-0 fw-bold text-dark">
                <i class="fas fa-shopping-bag me-2 text-primary"></i>
                {{ __('Sales') }}
            </h3>
        </div>
        <div class="col-md-6 text-md-end">
            <button class="btn btn-primary" wire:click="openCreateSale">
                <i class="fas fa-plus me-2"></i> {{ __('New Sale') }}
            </button>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-header pb-2">
            <input type="search" class="form-control w-50" placeholder="{{ __('Search...') }}"
                   wire:model.live.debounce.400ms="search">
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped align-middle mb-0">
                    <thead class="table-light">
                    <tr>
                        <th class="text-center">#</th>
                        <th>{{ __('Invoice') }}</th>
                        <th>{{ __('Customer') }}</th>
                        <th>{{ __('Date') }}</th>
                        <th class="text-end">{{ __('Total') }}</th>
                        <th class="text-end">{{ __('Paid') }}</th>
                        <th class="text-end">{{ __('Due') }}</th>
                        <th>{{ __('Payment') }}</th>
                        <th>{{ __('Status') }}</th>
                        <th class="text-center">{{ __('Actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($sales as $index => $sale)
                        <tr>
                            <td class="text-center">{{ $sales->firstItem() + $index }}</td>
                            <td><code>{{ $sale->invoice_no }}</code></td>
                            <td>{{ $sale->customer?->name ?? 'Walk-in' }}</td>
                            <td>{{ $sale->sale_date->format('d M Y H:i') }}</td>
                            <td class="text-end">{{ number_format($sale->total, 2) }}</td>
                            <td class="text-end">{{ number_format($sale->paid_amount, 2) }}</td>
                            <td class="text-end text-danger fw-bold">{{ number_format($sale->due_amount, 2) }}</td>
                            <td>
                                @if($sale->payment_status === 'paid')
                                    <span class="badge bg-success">Paid</span>
                                @elseif($sale->payment_status === 'partial')
                                    <span class="badge bg-warning">Partial</span>
                                @else
                                    <span class="badge bg-danger">Due</span>
                                @endif
                            </td>
                            <td>
                                @if($sale->sale_status === 'completed')
                                    <span class="badge bg-primary">Completed</span>
                                @elseif($sale->sale_status === 'returned')
                                    <span class="badge bg-secondary">Returned</span>
                                @else
                                    <span class="badge bg-info">Draft</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-outline-primary"
                                        wire:click="editSale({{ $sale->id }})">
                                    <i class="fas fa-edit"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center py-5 text-muted">
                                {{ __('No sales found.') }}
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-footer d-flex justify-content-between align-items-center">
            {{ $sales->links('vendor.pagination.bootstrap-5') }}
            <small class="text-muted">
                Showing {{ $sales->count() }} of {{ $sales->total() }}
            </small>
        </div>
    </div>

    <livewire:management.sales.create-sale />
    <livewire:management.sales.update-sale />
</div>