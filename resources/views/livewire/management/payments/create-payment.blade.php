<div class="modal fade" id="createPaymentModal" tabindex="-1" aria-hidden="true" wire:ignore.self data-bs-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content rounded-4 shadow border-0">
            <div class="modal-header bg-success text-white rounded-top-4">
                <h5 class="modal-title fw-bold">
                    <i class="fas fa-plus-circle me-2"></i> {{ __('Create Payment') }}
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <form wire:submit.prevent="save">
                <div class="modal-body">
                    <div class="row g-3">

                        <div class="col-md-6">
                            <label class="form-label fw-bold">{{ __('Branch') }} <span class="text-danger">*</span></label>
                            <select class="form-select @error('branch_id') is-invalid @enderror" wire:model="branch_id">
                                <option value="">— {{ __('Choose') }} —</option>
                                @foreach($branches as $b)
                                    <option value="{{ $b->id }}">{{ $b->name }}</option>
                                @endforeach
                            </select>
                            @error('branch_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">{{ __('Payment Type') }}</label>
                            <select class="form-select" wire:model.live="payment_type">
                                <option value="other">{{ __('Other') }}</option>
                                <option value="sale">{{ __('Sale') }}</option>
                                <option value="purchase">{{ __('Purchase') }}</option>
                                <option value="customer">{{ __('Customer') }}</option>
                                <option value="supplier">{{ __('Supplier') }}</option>
                            </select>
                        </div>

                        @if($payment_type === 'sale')
                            <div class="col-md-6">
                                <label class="form-label fw-bold">{{ __('Sale') }} <span class="text-danger">*</span></label>
                                <select class="form-select @error('sale_id') is-invalid @enderror" wire:model="sale_id">
                                    <option value="">— {{ __('Choose') }} —</option>
                                    @foreach($sales as $sale)
                                        <option value="{{ $sale->id }}">{{ $sale->invoice_no }}</option>
                                    @endforeach
                                </select>
                                @error('sale_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        @endif

                        @if($payment_type === 'purchase')
                            <div class="col-md-6">
                                <label class="form-label fw-bold">{{ __('Purchase') }} <span class="text-danger">*</span></label>
                                <select class="form-select @error('purchase_id') is-invalid @enderror" wire:model="purchase_id">
                                    <option value="">— {{ __('Choose') }} —</option>
                                    @foreach($purchases as $purchase)
                                        <option value="{{ $purchase->id }}">{{ $purchase->invoice_no }}</option>
                                    @endforeach
                                </select>
                                @error('purchase_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        @endif

                        @if($payment_type === 'customer')
                            <div class="col-md-6">
                                <label class="form-label fw-bold">{{ __('Customer') }} <span class="text-danger">*</span></label>
                                <select class="form-select @error('customer_id') is-invalid @enderror" wire:model="customer_id">
                                    <option value="">— {{ __('Choose') }} —</option>
                                    @foreach($customers as $customer)
                                        <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                    @endforeach
                                </select>
                                @error('customer_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        @endif

                        @if($payment_type === 'supplier')
                            <div class="col-md-6">
                                <label class="form-label fw-bold">{{ __('Supplier') }} <span class="text-danger">*</span></label>
                                <select class="form-select @error('supplier_id') is-invalid @enderror" wire:model="supplier_id">
                                    <option value="">— {{ __('Choose') }} —</option>
                                    @foreach($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                    @endforeach
                                </select>
                                @error('supplier_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        @endif

                        <div class="col-md-6">
                            <label class="form-label fw-bold">{{ __('Payment Date') }} <span class="text-danger">*</span></label>
                            <input type="datetime-local" class="form-control @error('payment_date') is-invalid @enderror"
                                   wire:model="payment_date">
                            @error('payment_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">{{ __('Amount') }} <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" class="form-control @error('amount') is-invalid @enderror"
                                   wire:model="amount" placeholder="0.00">
                            @error('amount') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">{{ __('Payment Method') }} <span class="text-danger">*</span></label>
                            <select class="form-select @error('payment_method') is-invalid @enderror" wire:model="payment_method">
                                <option value="cash">{{ __('Cash') }}</option>
                                <option value="card">{{ __('Card') }}</option>
                                <option value="aba">{{ __('ABA') }}</option>
                                <option value="acleda">{{ __('ACLEDA') }}</option>
                                <option value="wing">{{ __('Wing') }}</option>
                                <option value="bank">{{ __('Bank Transfer') }}</option>
                            </select>
                            @error('payment_method') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">{{ __('Reference / Transaction No') }}</label>
                            <input type="text" class="form-control @error('reference_no') is-invalid @enderror"
                                   wire:model="reference_no" placeholder="Bank slip, receipt number...">
                            @error('reference_no') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-bold">{{ __('Note') }}</label>
                            <textarea class="form-control @error('note') is-invalid @enderror" rows="3"
                                      wire:model="note" placeholder="Additional details..."></textarea>
                            @error('note') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                    </div>
                </div>

                <div class="modal-footer bg-light rounded-bottom-4">
                    <button type="button" class="btn btn-outline-secondary px-4" data-bs-dismiss="modal">{{ __('Cancel') }}</button>

                    <button type="submit" class="btn btn-success px-5" wire:loading.attr="disabled">
                        <span wire:loading.remove>
                            <i class="fas fa-save me-2"></i> {{ __('Save') }}
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
    Livewire.on('open-create-payment', () => {
        bootstrap.Modal.getOrCreateInstance(document.getElementById('createPaymentModal'))?.show();
    });

    Livewire.on('close-create-payment', () => {
        bootstrap.Modal.getOrCreateInstance(document.getElementById('createPaymentModal'))?.hide();
    });
});
</script>