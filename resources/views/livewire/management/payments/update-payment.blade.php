<div class="modal fade" id="updatePaymentModal" tabindex="-1" aria-hidden="true" wire:ignore.self data-bs-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content rounded-4 shadow border-0">
            <div class="modal-header bg-warning text-dark rounded-top-4">
                <h5 class="modal-title fw-bold">
                    <i class="fas fa-edit me-2"></i> Edit Payment
                    @if($payment)
                        <small class="text-muted ms-2">#{{ $payment->id }}</small>
                    @else
                        <small class="text-muted ms-2">(loading...)</small>
                    @endif
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form wire:submit.prevent="update">
                <div class="modal-body">

                    @if($payment)
                        <!-- Show related entity (read-only) -->
                        <div class="alert alert-info mb-4">
                            <strong>Related to:</strong>
                            @if($payment->sale_id)
                                Sale #{{ $payment->sale_id }}
                            @elseif($payment->purchase_id)
                                Purchase #{{ $payment->purchase_id }}
                            @elseif($payment->customer_id)
                                Customer: {{ $payment->customer?->name ?? 'ID '.$payment->customer_id }}
                            @elseif($payment->supplier_id)
                                Supplier: {{ $payment->supplier?->name ?? 'ID '.$payment->supplier_id }}
                            @else
                                General / Other Payment
                            @endif
                        </div>

                        <div class="row g-3">

                            <div class="col-md-6">
                                <label class="form-label fw-bold">Branch <span class="text-danger">*</span></label>
                                <select class="form-select @error('branch_id') is-invalid @enderror" wire:model="branch_id">
                                    <option value="">— Select branch —</option>
                                    @foreach($branches as $b)
                                        <option value="{{ $b->id }}">{{ $b->name }}</option>
                                    @endforeach
                                </select>
                                @error('branch_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold">Payment Date <span class="text-danger">*</span></label>
                                <input type="datetime-local" class="form-control @error('payment_date') is-invalid @enderror"
                                       wire:model="payment_date">
                                @error('payment_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold">Amount <span class="text-danger">*</span></label>
                                <input type="number" step="0.01" class="form-control @error('amount') is-invalid @enderror"
                                       wire:model="amount" placeholder="0.00">
                                @error('amount') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold">Payment Method <span class="text-danger">*</span></label>
                                <select class="form-select @error('payment_method') is-invalid @enderror" wire:model="payment_method">
                                    <option value="cash">Cash</option>
                                    <option value="card">Card</option>
                                    <option value="aba">ABA</option>
                                    <option value="acleda">ACLEDA</option>
                                    <option value="wing">Wing</option>
                                    <option value="bank">Bank Transfer</option>
                                </select>
                                @error('payment_method') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold">Reference / Transaction No</label>
                                <input type="text" class="form-control @error('reference_no') is-invalid @enderror"
                                       wire:model="reference_no" placeholder="Bank slip, receipt number...">
                                @error('reference_no') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-bold">Note / Remark</label>
                                <textarea class="form-control @error('note') is-invalid @enderror" rows="3"
                                          wire:model="note" placeholder="Additional details..."></textarea>
                                @error('note') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-spinner fa-spin me-2"></i> Loading payment...
                        </div>
                    @endif

                </div>

                <div class="modal-footer bg-light rounded-bottom-4">
                    <button type="button" class="btn btn-outline-secondary px-4" data-bs-dismiss="modal">Cancel</button>

                    <button type="submit" class="btn btn-warning px-5" wire:loading.attr="disabled" @if(!$payment) disabled @endif>
                        <span wire:loading.remove>
                            <i class="fas fa-save me-2"></i> Update Payment
                        </span>
                        <span wire:loading>
                            <i class="fas fa-spinner fa-spin me-2"></i> Saving...
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('livewire:init', () => {
    Livewire.on('open-update-payment-modal', () => {
        bootstrap.Modal.getOrCreateInstance(document.getElementById('updatePaymentModal'))?.show();
    });

    Livewire.on('close-update-payment-modal', () => {
        bootstrap.Modal.getOrCreateInstance(document.getElementById('updatePaymentModal'))?.hide();
    });
});
</script>