<div class="container-fluid">
    <div class="row align-items-center g-3 mb-4">
        <div class="col-md-6">
            <h3 class="mb-0 fw-bold text-dark">
                <i class="fas fa-exchange-alt me-2" style="color: #5AC559;"></i>
                {{ __('Stock Movements') }}
            </h3>
        </div>
        <div class="col-md-6 text-md-end">
            <button type="button" class="btn btn-primary" wire:click="openCreateModal">
                <i class="fas fa-plus me-2"></i>
                {{ __('New Adjustment') }}
            </button>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-header pb-2">
            <div class="row g-3 align-items-center">
                <div class="col-md-4 col-lg-3">
                    <label class="form-label text-muted mb-1">{{ __('Search') }}</label>
                    <input type="search" class="form-control" wire:model.live.debounce.500ms="search"
                           placeholder="{{ __('Search...') }}">
                </div>
                <div class="col-md-3 col-lg-2">
                    <label class="form-label text-muted mb-1">{{ __('Branch') }}</label>
                    <select class="form-select" wire:model.live="branchId">
                        <option value="">{{ __('All Branches') }}</option>
                        @foreach (\App\Models\Branch::where('status', true)->get() as $branch)
                            <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="card-body p-0">
            <!-- Loading overlay -->
            <div wire:loading wire:target="search,branchId">
                <div class="position-absolute top-0 start-0 w-100 h-100 bg-white bg-opacity-75 d-flex flex-column align-items-center justify-content-center z-3">
                    <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                        <span class="visually-hidden">{{ __('Loading...') }}</span>
                    </div>
                    <p class="mt-3 text-muted">{{ __('Loading...') }}</p>
                </div>
            </div>

            <div class="table-responsive" wire:loading.remove wire:target="search,branchId">
                <table class="table table-hover table-striped align-middle mb-0">
                    <thead class="table-light">
                    <tr>
                        <th class="text-center" style="width:60px;">No.</th>
                        <th>{{ __('Date') }}</th>
                        <th>{{ __('Branch') }}</th>
                        <th>{{ __('Product') }}</th>
                        <th class="text-center">{{ __('Type') }}</th>
                        <th class="text-end">{{ __('In') }}</th>
                        <th class="text-end">{{ __('Out') }}</th>
                        <th class="text-end">{{ __('Balance') }}</th>
                        <th>{{ __('Note') }}</th>
                        <th>{{ __('Created By') }}</th>
                        <th class="text-center">{{ __('Actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($movements as $index => $movement)
                        <tr>
                            <td class="text-center">{{ $movements->firstItem() + $index }}</td>
                            <td>{{ $movement->created_at->format('d M Y H:i') }}</td>
                            <td>{{ $movement->branch?->name ?? '—' }}</td>
                            <td>
                                {{ $movement->product?->name ?? '—' }}
                                <small class="d-block text-muted">{{ $movement->product?->code ?? '' }}</small>
                            </td>
                            <td class="text-center">
                                @switch($movement->type)
                                    @case('purchase')
                                        <span class="badge bg-success">Purchase</span>
                                        @break
                                    @case('sale')
                                        <span class="badge bg-danger">Sale</span>
                                        @break
                                    @case('sale_return')
                                        <span class="badge bg-info">Sale Return</span>
                                        @break
                                    @case('purchase_return')
                                        <span class="badge bg-warning">Purchase Return</span>
                                        @break
                                    @case('adjustment')
                                        <span class="badge bg-secondary">Adjustment</span>
                                        @break
                                    @default
                                        <span class="badge bg-dark">{{ ucfirst($movement->type) }}</span>
                                @endswitch
                            </td>
                            <td class="text-end fw-bold text-success">
                                {{ $movement->qty_in > 0 ? number_format($movement->qty_in, 2) : '—' }}
                            </td>
                            <td class="text-end fw-bold text-danger">
                                {{ $movement->qty_out > 0 ? number_format($movement->qty_out, 2) : '—' }}
                            </td>
                            <td class="text-end fw-bold">
                                {{ number_format($movement->balance_after, 2) }}
                            </td>
                            <td>{{ Str::limit($movement->note ?? '—', 60) }}</td>
                            <td>{{ $movement->user?->name ?? 'System' }}</td>
                            <td class="text-center">
                                @if($movement->type === 'adjustment')
                                    <button class="btn btn-sm btn-outline-secondary"
                                            wire:click="editMovement({{ $movement->id }})"
                                            title="Edit note">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                @else
                                    <button class="btn btn-sm btn-outline-secondary" disabled>
                                        <i class="fas fa-edit"></i>
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="11" class="text-center py-5 text-muted">
                                {{ __('No stock movements found.') }}
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            <div class="card-footer d-flex justify-content-between align-items-center">
                <div>
                    {{ $movements->links('vendor.pagination.bootstrap-5') }}
                </div>
                <small class="text-muted">
                    Showing {{ $movements->count() }} of {{ $movements->total() }} movements
                </small>
            </div>
        </div>
    </div>

    <!-- Include both modals -->
    <livewire:management.stock-movements.create-stock-movement />
    <livewire:management.stock-movements.update-stock-movement />
</div>