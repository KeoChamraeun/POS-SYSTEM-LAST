<div class="modal fade" id="createPurchaseModal" tabindex="-1" aria-hidden="true" wire:ignore.self data-bs-backdrop="static">
    <div class="modal-dialog modal-xl">
        <div class="modal-content rounded-4 shadow-lg border-0 overflow-hidden">

            <!-- Header -->
            <div class="modal-header bg-gradient-success text-white border-0 pb-1">
                <div class="d-flex align-items-center">
                    <div class="bg-white bg-opacity-25 p-2 rounded-circle me-3">
                        <i class="fas fa-cart-plus fa-lg"></i>
                    </div>
                    <h5 class="modal-title fw-bold mb-0">Create New Purchase</h5>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form wire:submit.prevent="save" class="d-flex flex-column flex-grow-1">

                <div class="modal-body bg-light-subtle pb-4">

                    <!-- Header Information -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body">
                            <div class="row g-4">
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold text-muted small">SUPPLIER <span class="text-danger">*</span></label>
                                    <select class="form-select form-select-lg border-primary @error('supplier_id') is-invalid @enderror"
                                            wire:model.live="supplier_id">
                                        <option value="">Select supplier...</option>
                                        @foreach($suppliers as $supplier)
                                            <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('supplier_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label fw-semibold text-muted small">BRANCH <span class="text-danger">*</span></label>
                                    <select class="form-select form-select-lg border-primary @error('branch_id') is-invalid @enderror"
                                            wire:model.live="branch_id">
                                        <option value="">Select branch...</option>
                                        @foreach($branches as $branch)
                                            <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('branch_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label fw-semibold text-muted small">PURCHASE DATE <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control form-control-lg border-primary @error('purchase_date') is-invalid @enderror"
                                           wire:model.live="purchase_date">
                                    @error('purchase_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold text-muted small">INVOICE / REFERENCE NO <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-lg @error('invoice_no') is-invalid @enderror"
                                           wire:model.live.debounce.500ms="invoice_no"
                                           placeholder="PUR-{{ now()->format('ymd') }}-XXXX">
                                    @error('invoice_no') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Items Section -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center py-3">
                            <h6 class="mb-0 fw-semibold text-dark">
                                <i class="fas fa-boxes-stacked me-2 text-success"></i>Purchase Items
                            </h6>
                            <button type="button" class="btn btn-success btn-sm px-3" wire:click="addItem">
                                <i class="fas fa-plus me-1"></i> Add Item
                            </button>
                        </div>

                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover table-borderless align-middle mb-0">
                                    <thead class="table-light border-bottom">
                                        <tr class="text-nowrap">
                                            <th class="ps-4 py-3">Product</th>
                                            <th class="text-end py-3" width="130">Quantity</th>
                                            <th class="text-end py-3" width="150">Unit Cost</th>
                                            <th class="text-end py-3" width="150">Line Total</th>
                                            <th class="py-3" width="170">Expiry Date</th>
                                            <th width="60"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($items as $index => $item)
                                            <tr wire:key="item-{{ $index }}">
                                                <td class="ps-4">
                                                    <select class="form-select @error("items.$index.product_id") is-invalid @enderror"
                                                            wire:model.live="items.{{ $index }}.product_id">
                                                        <option value="">— Choose product —</option>
                                                        @foreach($products as $p)
                                                            <option value="{{ $p->id }}">{{ $p->name }} • {{ $p->code }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error("items.$index.product_id") <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                                </td>
                                                <td>
                                                    <input type="number" step="0.001" min="0.001" class="form-control text-end @error("items.$index.quantity") is-invalid @enderror"
                                                           wire:model.live.debounce.400ms="items.{{ $index }}.quantity"
                                                           placeholder="0.00">
                                                    @error("items.$index.quantity") <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                                </td>
                                                <td>
                                                    <input type="number" step="0.01" min="0" class="form-control text-end @error("items.$index.unit_cost") is-invalid @enderror"
                                                           wire:model.live.debounce.400ms="items.{{ $index }}.unit_cost"
                                                           placeholder="0.00">
                                                    @error("items.$index.unit_cost") <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                                </td>
                                                <td class="text-end fw-medium text-dark">
                                                    {{ number_format($item['line_total'] ?? 0, 2) }}
                                                </td>
                                                <td>
                                                    <input type="date" class="form-control @error("items.$index.expiry_date") is-invalid @enderror"
                                                           wire:model="items.{{ $index }}.expiry_date">
                                                    @error("items.$index.expiry_date") <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                                </td>
                                                <td class="text-center">
                                                    @if(count($items) > 1)
                                                        <button type="button" class="btn btn-sm btn-link text-danger p-1"
                                                                wire:click="removeItem({{ $index }})" title="Remove item">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center text-muted py-5">
                                                    <i class="fas fa-box-open fa-2x mb-3 d-block text-muted opacity-50"></i>
                                                    No items added yet.<br>
                                                    Click "Add Item" to start.
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
                                    <label class="form-label fw-semibold text-muted small">NOTES / REMARKS / PAYMENT TERMS</label>
                                    <textarea class="form-control form-control-lg" rows="5" wire:model="note"
                                              placeholder="Delivery instructions, special terms, internal reference..."></textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Summary -->
                        <div class="col-lg-5">
                            <div class="card border-0 shadow-sm bg-white h-100">
                                <div class="card-body d-flex flex-column">
                                    <h6 class="fw-bold mb-4 border-bottom pb-2">
                                        <i class="fas fa-calculator me-2 text-success"></i> Financial Summary
                                    </h6>

                                    <div class="mt-auto">
                                        <div class="d-flex justify-content-between mb-2 text-muted small">
                                            <span>Subtotal</span>
                                            <span class="fw-medium">{{ number_format($subtotal ?? 0, 2) }}</span>
                                        </div>

                                        <div class="input-group input-group-sm mb-2">
                                            <span class="input-group-text">Discount</span>
                                            <input type="number" step="0.01" class="form-control text-end" wire:model.live.debounce.500ms="discount">
                                        </div>

                                        <div class="input-group input-group-sm mb-2">
                                            <span class="input-group-text">Tax</span>
                                            <input type="number" step="0.01" class="form-control text-end" wire:model.live.debounce.500ms="tax">
                                        </div>

                                        <hr class="my-3">

                                        <div class="d-flex justify-content-between align-items-center mb-3 fw-bold fs-5">
                                            <span>Grand Total</span>
                                            <span class="text-success">{{ number_format($total ?? 0, 2) }}</span>
                                        </div>

                                        <div class="input-group input-group-sm mb-2">
                                            <span class="input-group-text">Paid Amount</span>
                                            <input type="number" step="0.01" class="form-control text-end" wire:model.live.debounce.500ms="paid_amount">
                                        </div>

                                        <div class="d-flex justify-content-between align-items-center fw-bold text-danger fs-5">
                                            <span>Amount Due</span>
                                            <span>{{ number_format($due_amount ?? 0, 2) }}</span>
                                        </div>

                                        <!-- Mobile-friendly extra save button -->
                                        <div class="mt-4 text-end d-lg-none">
                                            <button type="submit" class="btn btn-success px-5 py-3 fw-semibold" wire:loading.attr="disabled">
                                                <span wire:loading.remove><i class="fas fa-save me-2"></i> Save Purchase</span>
                                                <span wire:loading><i class="fas fa-spinner fa-spin me-2"></i> Saving...</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Footer – always visible when you scroll to bottom -->
                <div class="modal-footer bg-white border-0 px-4 py-3">
                    <button type="button" class="btn btn-outline-secondary px-5 py-2" data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-success px-5 py-2 fw-semibold" wire:loading.attr="disabled">
                        <span wire:loading.remove>
                            <i class="fas fa-check-circle me-2"></i> Create Purchase
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
    Livewire.on('open-create-purchase', () => {
        const modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('createPurchaseModal'));
        if (modal) modal.show();
    });

    Livewire.on('close-create-purchase', () => {
        const modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('createPurchaseModal'));
        if (modal) modal.hide();
    });
});
</script>