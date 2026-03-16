<div class="modal fade" id="updatePurchaseModal" tabindex="-1" aria-hidden="true" wire:ignore.self data-bs-backdrop="static">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content rounded-4 shadow border-0">
            <div class="modal-header bg-warning text-dark rounded-top-4">
                <h5 class="modal-title fw-bold">
                    <i class="fas fa-edit me-2"></i> Edit Purchase #{{ $purchase?->invoice_no ?? '' }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form wire:submit.prevent="update">
                <div class="modal-body">

                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Supplier</label>
                            <input type="text" class="form-control bg-light" readonly value="{{ $purchase?->supplier?->name ?? '—' }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Branch</label>
                            <input type="text" class="form-control bg-light" readonly value="{{ $purchase?->branch?->name ?? '—' }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Purchase Date</label>
                            <input type="text" class="form-control bg-light" readonly value="{{ $purchase?->purchase_date?->format('d M Y') }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Invoice No</label>
                            <input type="text" class="form-control bg-light" readonly value="{{ $purchase?->invoice_no }}">
                        </div>
                    </div>

                    <!-- Items (read-only) -->
                    <div class="card mb-4">
                        <div class="card-header bg-light">
                            <h6 class="mb-0">Purchase Items</h6>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-bordered mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Product</th>
                                            <th class="text-end">Qty</th>
                                            <th class="text-end">Unit Cost</th>
                                            <th class="text-end">Total</th>
                                            <th>Expiry</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($purchase?->items ?? [] as $item)
                                            <tr>
                                                <td>{{ $item->product?->name ?? '—' }} ({{ $item->product?->code ?? '' }})</td>
                                                <td class="text-end">{{ number_format($item->qty, 2) }}</td>
                                                <td class="text-end">{{ number_format($item->cost_price, 2) }}</td>
                                                <td class="text-end">{{ number_format($item->total, 2) }}</td>
                                                <td>{{ $item->expiry_date?->format('d M Y') ?? '—' }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center py-3 text-muted">No items</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Summary & editable fields -->
                    <div class="row g-3 justify-content-end">
                        <div class="col-md-4">
                            <div class="input-group mb-2">
                                <span class="input-group-text">Subtotal</span>
                                <input type="text" class="form-control text-end bg-light" readonly value="{{ number_format($purchase?->subtotal ?? 0, 2) }}">
                            </div>

                            <div class="input-group mb-2">
                                <span class="input-group-text">Discount</span>
                                <input type="number" step="0.01" class="form-control text-end" wire:model="discount">
                            </div>

                            <div class="input-group mb-2">
                                <span class="input-group-text">Tax</span>
                                <input type="number" step="0.01" class="form-control text-end" wire:model="tax">
                            </div>

                            <div class="input-group mb-2 fw-bold">
                                <span class="input-group-text">Grand Total</span>
                                <input type="text" class="form-control text-end bg-light fw-bold" readonly value="{{ number_format($purchase?->total ?? 0, 2) }}">
                            </div>

                            <div class="input-group mb-2">
                                <span class="input-group-text">Paid Amount</span>
                                <input type="number" step="0.01" class="form-control text-end" wire:model="paid_amount">
                            </div>

                            <div class="input-group fw-bold text-danger">
                                <span class="input-group-text">Due Amount</span>
                                <input type="text" class="form-control text-end bg-light fw-bold" readonly value="{{ number_format($purchase?->due_amount ?? 0, 2) }}">
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <label class="form-label fw-bold">Note / Remarks</label>
                        <textarea class="form-control" rows="3" wire:model="note"></textarea>
                    </div>

                </div>

                <div class="modal-footer bg-light rounded-bottom-4">
                    <button type="button" class="btn btn-outline-secondary px-4" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-warning px-5" wire:loading.attr="disabled">
                        <span wire:loading.remove><i class="fas fa-save me-2"></i> Update</span>
                        <span wire:loading><i class="fas fa-spinner fa-spin me-2"></i> Saving...</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('livewire:init', () => {
    Livewire.on('open-update-purchase-modal', () => {
        bootstrap.Modal.getOrCreateInstance(document.getElementById('updatePurchaseModal'))?.show();
    });

    Livewire.on('close-update-purchase-modal', () => {
        bootstrap.Modal.getOrCreateInstance(document.getElementById('updatePurchaseModal'))?.hide();
    });
});
</script>