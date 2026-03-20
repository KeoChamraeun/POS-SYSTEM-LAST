<div class="modal fade" id="updateSaleModal" tabindex="-1" aria-hidden="true" wire:ignore.self data-bs-backdrop="static">
    <div class="modal-dialog modal-xl">
        <div class="modal-content rounded-4 shadow-lg border-0 overflow-hidden">

            <!-- Header -->
            <div class="modal-header bg-primary text-dark border-0 pb-1">
                <div class="d-flex align-items-center">
                    <div class="bg-white bg-opacity-25 p-2 rounded-circle me-3">
                        <i class="fas fa-edit fa-lg"></i>
                    </div>
                    <h5 class="modal-title fw-bold mb-0">
                        {{ __('Edit Sale') }}
                        @if($sale) <small class="text-muted ms-2">#{{ $sale->invoice_no }}</small> @endif
                    </h5>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form wire:submit.prevent="update" class="d-flex flex-column flex-grow-1">

                <div class="modal-body bg-light-subtle pb-4">

                    <!-- Header Information (mostly read-only) -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body">
                            <div class="row g-4">
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold text-muted small">{{ __('Branch') }}</label>
                                    <input type="text" class="form-control form-control-lg bg-light" readonly
                                           value="{{ $sale?->branch?->name ?? '—' }}">
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label fw-semibold text-muted small">{{ __('Customer') }}</label>
                                    <input type="text" class="form-control form-control-lg bg-light" readonly
                                           value="{{ $sale?->customer?->name ?? __('Walk-in') }}">
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label fw-semibold text-muted small">{{ __('Sale Date') }}</label>
                                    <input type="text" class="form-control form-control-lg bg-light" readonly
                                           value="{{ $sale?->sale_date?->format('d M Y H:i') ?? '—' }}">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold text-muted small">{{ __('Invoice NO') }}</label>
                                    <input type="text" class="form-control form-control-lg bg-light" readonly
                                           value="{{ $sale?->invoice_no ?? '—' }}">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold text-muted small">{{ __('Sale Status') }}</label>
                                    <select class="form-select form-select-lg @error('sale_status') is-invalid @enderror" wire:model="sale_status">
                                        <option value="completed">{{ __('Completed') }}</option>
                                        <option value="returned">{{ __('Returned') }}</option>
                                        <option value="draft">{{ __('Draft') }}</option>
                                    </select>
                                    @error('sale_status') <div class="invalid-feedback">{{ __($message) }}</div> @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Items Section (read-only) -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-white border-bottom py-3">
                            <h6 class="mb-0 fw-semibold text-dark">
                                <i class="fas fa-boxes-stacked me-2 text-primary"></i>{{ __('Sale Items') }}
                            </h6>
                        </div>

                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover table-borderless align-middle mb-0">
                                    <thead class="table-light border-bottom">
                                        <tr class="text-nowrap">
                                            <th class="ps-4 py-3">{{ __('Product') }}</th>
                                            <th class="text-end py-3" width="130">{{ __('Quantity') }}</th>
                                            <th class="text-end py-3" width="150">{{ __('Unit Price') }}</th>
                                            <th class="text-end py-3" width="120">{{ __('Discount') }}</th>
                                            <th class="text-end py-3" width="150">{{ __('Line Total') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($sale?->items ?? [] as $item)
                                            <tr>
                                                <td class="ps-4">{{ $item->product?->name ?? '—' }}</td>
                                                <td class="text-end">{{ number_format($item->qty ?? 0, 2) }}</td>
                                                <td class="text-end">{{ number_format($item->unit_price ?? 0, 2) }}</td>
                                                <td class="text-end">{{ number_format($item->discount ?? 0, 2) }}</td>
                                                <td class="text-end fw-medium text-dark">
                                                    {{ number_format($item->total ?? 0, 2) }}
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
                                    <textarea class="form-control form-control-lg" rows="5" wire:model="note"
                                              placeholder="Customer feedback, return reason, internal note..."></textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Summary -->
                        <div class="col-lg-5">
                            <div class="card border-0 shadow-sm bg-white h-100">
                                <div class="card-body d-flex flex-column">
                                    <h6 class="fw-bold mb-4 border-bottom pb-2">
                                        <i class="fas fa-calculator me-2 text-primary"></i> {{ __('Financial Summary') }}
                                    </h6>

                                    <div class="mt-auto">
                                        <div class="d-flex justify-content-between mb-2 text-muted small">
                                            <span>{{ __('Subtotal') }}</span>
                                            <span class="fw-medium">{{ number_format($sale?->subtotal ?? 0, 2) }}</span>
                                        </div>

                                        <div class="input-group input-group-sm mb-2">
                                            <span class="input-group-text">{{ __('Discount') }}</span>
                                            <input type="number" step="0.01" class="form-control text-end" wire:model.live.debounce.500ms="discount">
                                        </div>

                                        <div class="input-group input-group-sm mb-2">
                                            <span class="input-group-text">{{ __('Tax') }}</span>
                                            <input type="number" step="0.01" class="form-control text-end" wire:model.live.debounce.500ms="tax">
                                        </div>

                                        <hr class="my-3">

                                        <div class="d-flex justify-content-between align-items-center mb-3 fw-bold fs-5">
                                            <span>{{ __('Grand Total') }}</span>
                                            <span class="text-primary">{{ number_format($sale?->total ?? 0, 2) }}</span>
                                        </div>

                                        <div class="input-group input-group-sm mb-2">
                                            <span class="input-group-text">{{ __('Paid Amount') }}</span>
                                            <input type="number" step="0.01" class="form-control text-end" wire:model.live.debounce.500ms="paid_amount">
                                        </div>

                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <span>{{ __('Change') }}</span>
                                            <span class="fw-medium">{{ number_format($sale?->change_amount ?? 0, 2) }}</span>
                                        </div>

                                        <div class="d-flex justify-content-between align-items-center fw-bold text-danger fs-5">
                                            <span>{{ __('Amount Due') }}</span>
                                            <span>{{ number_format($sale?->due_amount ?? 0, 2) }}</span>
                                        </div>

                                        <!-- Mobile-friendly save button -->
                                        <div class="mt-4 text-end d-lg-none">
                                            <button type="submit" class="btn btn-primary px-5 py-3 fw-semibold" wire:loading.attr="disabled">
                                                <span wire:loading.remove><i class="fas fa-save me-2"></i> {{ __('Update') }}</span>
                                                <span wire:loading><i class="fas fa-spinner fa-spin me-2"></i> {{ __('Saving...') }}</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="modal-footer bg-white border-0 px-4 py-3">
                    <button type="button" class="btn btn-outline-secondary px-5 py-2" data-bs-dismiss="modal">
                        {{ __('Cancel') }}
                    </button>
                    <button type="submit" class="btn btn-primary px-5 py-2 fw-semibold" wire:loading.attr="disabled">
                        <span wire:loading.remove>
                            <i class="fas fa-check-circle me-2"></i> {{ __('Update') }}
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
    Livewire.on('open-edit-sale', () => {
        const modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('updateSaleModal'));
        if (modal) modal.show();
    });

    Livewire.on('close-edit-sale', () => {
        const modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('updateSaleModal'));
        if (modal) modal.hide();
    });
});
</script>