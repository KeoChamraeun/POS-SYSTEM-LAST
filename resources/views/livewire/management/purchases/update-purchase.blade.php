<div class="modal fade" id="updatePurchaseModal" tabindex="-1" aria-hidden="true" wire:ignore.self data-bs-backdrop="static">
    <div class="modal-dialog modal-xl">
        <div class="modal-content rounded-4 shadow-lg border-0 overflow-hidden">

            <!-- Header -->
            <div class="modal-header bg-primary text-dark border-0 pb-1">
                <div class="d-flex align-items-center">
                    <div class="bg-white bg-opacity-50 p-2 rounded-circle me-3">
                        <i class="fas fa-pen-to-square fa-lg text-dark"></i>
                    </div>
                    <h5 class="modal-title fw-bold mb-0">
                        {{ __('Update Purchase') }}
                        <span class="ms-1 text-dark-emphasis">#{{ $purchase?->invoice_no ?? '' }}</span>
                    </h5>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form wire:submit.prevent="update" class="d-flex flex-column flex-grow-1">

                <div class="modal-body bg-light-subtle pb-4">

                    <!-- Header Information -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body">
                            <div class="row g-4">

                                <div class="col-md-4">
                                    <label class="form-label fw-semibold text-muted small">{{ __('SUPPLIER') }}</label>
                                    <input type="text"
                                           class="form-control form-control-lg bg-light border-warning-subtle"
                                           readonly
                                           value="{{ $purchase?->supplier?->name ?? '—' }}">
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label fw-semibold text-muted small">{{ __('Branch') }}</label>
                                    <input type="text"
                                           class="form-control form-control-lg bg-light border-warning-subtle"
                                           readonly
                                           value="{{ $purchase?->branch?->name ?? '—' }}">
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label fw-semibold text-muted small">{{ __('Purchase Date') }}</label>
                                    <input type="text"
                                           class="form-control form-control-lg bg-light border-warning-subtle"
                                           readonly
                                           value="{{ $purchase?->purchase_date?->format('Y-m-d') ?? '' }}">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold text-muted small">{{ __('INVOICE / REFERENCE NO') }}</label>
                                    <input type="text"
                                           class="form-control form-control-lg bg-light border-warning-subtle"
                                           readonly
                                           value="{{ $purchase?->invoice_no ?? '' }}">
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- Items Section -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center py-3">
                            <h6 class="mb-0 fw-semibold text-dark">
                                <i class="fas fa-boxes-stacked me-2 text-warning"></i>{{ __('Purchase Items') }}
                            </h6>
                            <span class="badge bg-warning-subtle text-dark border px-3 py-2">
                                {{ __('Read Only') }}
                            </span>
                        </div>

                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover table-borderless align-middle mb-0">
                                    <thead class="table-light border-bottom">
                                        <tr class="text-nowrap">
                                            <th class="ps-4 py-3">{{ __('Product') }}</th>
                                            <th class="text-end py-3" width="130">{{ __('Quantity') }}</th>
                                            <th class="text-end py-3" width="150">{{ __('Unit Cost') }}</th>
                                            <th class="text-end py-3" width="150">{{ __('Line Total') }}</th>
                                            <th class="py-3" width="170">{{ __('Expiry Date') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($purchase?->items ?? [] as $item)
                                            <tr>
                                                <td class="ps-4">
                                                    <div class="fw-medium text-dark">
                                                        {{ $item->product?->name ?? '—' }}
                                                    </div>
                                                    <small class="text-muted">
                                                        {{ $item->product?->code ?? '' }}
                                                    </small>
                                                </td>
                                                <td class="text-end fw-medium">
                                                    {{ number_format($item->qty ?? 0, 3) }}
                                                </td>
                                                <td class="text-end">
                                                    {{ number_format($item->cost_price ?? 0, 2) }}
                                                </td>
                                                <td class="text-end fw-medium text-dark">
                                                    {{ number_format($item->total ?? 0, 2) }}
                                                </td>
                                                <td>
                                                    {{ $item->expiry_date?->format('Y-m-d') ?? '—' }}
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center text-muted py-5">
                                                    <i class="fas fa-box-open fa-2x mb-3 d-block text-muted opacity-50"></i>
                                                    {{ __('No items found') }}
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="row g-4">

                        <!-- Note -->
                        <div class="col-lg-7">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-body">
                                    <label class="form-label fw-semibold text-muted small">{{ __('Note') }}</label>
                                    <textarea class="form-control form-control-lg @error('note') is-invalid @enderror"
                                              rows="5"
                                              wire:model="note"
                                              placeholder="Update internal reference, remarks, payment note..."></textarea>
                                    @error('note')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Summary -->
                        <div class="col-lg-5">
                            <div class="card border-0 shadow-sm bg-white h-100">
                                <div class="card-body d-flex flex-column">
                                    <h6 class="fw-bold mb-4 border-bottom pb-2">
                                        <i class="fas fa-calculator me-2 text-warning"></i> {{ __('Financial Summary') }}
                                    </h6>

                                    <div class="mt-auto">
                                        <div class="d-flex justify-content-between mb-2 text-muted small">
                                            <span>{{ __('Subtotal') }}</span>
                                            <span class="fw-medium">{{ number_format($purchase?->subtotal ?? 0, 2) }}</span>
                                        </div>

                                        <div class="input-group input-group-sm mb-2">
                                            <span class="input-group-text">{{ __('Discount') }}</span>
                                            <input type="number"
                                                   step="0.01"
                                                   min="0"
                                                   class="form-control text-end @error('discount') is-invalid @enderror"
                                                   wire:model.live.debounce.500ms="discount">
                                        </div>
                                        @error('discount')
                                            <div class="text-danger small mb-2">{{ $message }}</div>
                                        @enderror

                                        <div class="input-group input-group-sm mb-2">
                                            <span class="input-group-text">{{ __('Tax') }}</span>
                                            <input type="number"
                                                   step="0.01"
                                                   min="0"
                                                   class="form-control text-end @error('tax') is-invalid @enderror"
                                                   wire:model.live.debounce.500ms="tax">
                                        </div>
                                        @error('tax')
                                            <div class="text-danger small mb-2">{{ $message }}</div>
                                        @enderror

                                        <hr class="my-3">

                                        <div class="d-flex justify-content-between align-items-center mb-3 fw-bold fs-5">
                                            <span>{{ __('Grand Total') }}</span>
                                            <span class="text-warning">
                                                {{ number_format($total ?? ($purchase?->total ?? 0), 2) }}
                                            </span>
                                        </div>

                                        <div class="input-group input-group-sm mb-2">
                                            <span class="input-group-text">{{ __('Paid Amount') }}</span>
                                            <input type="number"
                                                   step="0.01"
                                                   min="0"
                                                   class="form-control text-end @error('paid_amount') is-invalid @enderror"
                                                   wire:model.live.debounce.500ms="paid_amount">
                                        </div>
                                        @error('paid_amount')
                                            <div class="text-danger small mb-2">{{ $message }}</div>
                                        @enderror

                                        <div class="d-flex justify-content-between align-items-center fw-bold text-danger fs-5">
                                            <span>{{ __('Amount Due') }}</span>
                                            <span>{{ number_format($due_amount ?? ($purchase?->due_amount ?? 0), 2) }}</span>
                                        </div>

                                        <!-- Mobile save -->
                                        <div class="mt-4 text-end d-lg-none">
                                            <button type="submit" class="btn btn-primary px-5 py-3 fw-semibold" wire:loading.attr="disabled">
                                                <span wire:loading.remove>
                                                    <i class="fas fa-save me-2"></i> {{ __('Update') }}
                                                </span>
                                                <span wire:loading>
                                                    <i class="fas fa-spinner fa-spin me-2"></i> {{ __('Saving...') }}
                                                </span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

                <!-- Footer -->
                <div class="modal-footer bg-white border-0 px-4 py-3">
                    <button type="button" class="btn btn-outline-secondary px-5 py-2" data-bs-dismiss="modal">
                        {{ __('Cancel') }}
                    </button>
                    <button type="submit" class="btn btn-primary px-5 py-2 fw-semibold" wire:loading.attr="disabled">
                        <span wire:loading.remove>
                            <i class="fas fa-pen-to-square me-2"></i> {{ __('Update') }}
                        </span>
                        <span wire:loading>
                            <i class="fas fa-spinner fa-spin me-2"></i> {{ __('Saving...') }}
                        </span>
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('livewire:init', () => {
    Livewire.on('open-update-purchase-modal', () => {
        const modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('updatePurchaseModal'));
        if (modal) modal.show();
    });

    Livewire.on('close-update-purchase-modal', () => {
        const modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('updatePurchaseModal'));
        if (modal) modal.hide();
    });
});
</script>