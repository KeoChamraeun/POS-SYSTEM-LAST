<div class="modal fade" id="createSaleModal" tabindex="-1" aria-hidden="true" wire:ignore.self data-bs-backdrop="static">
    <div class="modal-dialog modal-xl">
        <div class="modal-content rounded-4 shadow-lg border-0 overflow-hidden">

            <!-- Header -->
            <div class="modal-header bg-primary text-white border-0 pb-1">
                <div class="d-flex align-items-center">
                    <div class="bg-white bg-opacity-25 p-2 rounded-circle me-3">
                        <i class="fas fa-shopping-bag fa-lg"></i>
                    </div>
                    <h5 class="modal-title fw-bold mb-0">{{ __('Create New Sale') }}</h5>
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
                                    <label class="form-label fw-semibold text-muted small">{{ __('Branch') }} <span class="text-danger">*</span></label>
                                    <select class="form-select form-select-lg border-primary @error('branch_id') is-invalid @enderror"
                                            wire:model.live="branch_id">
                                        <option value="">{{ __('Choose...') }}</option>
                                        @foreach($branches as $branch)
                                            <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('branch_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label fw-semibold text-muted small">{{ __('Customer') }}</label>
                                    <select class="form-select form-select-lg border-primary" wire:model="customer_id">
                                        <option value="">{{ __('Walk-in / No customer') }}</option>
                                        @foreach($customers as $customer)
                                            <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label fw-semibold text-muted small">{{ __('Sale Date') }} <span class="text-danger">*</span></label>
                                    <input type="datetime-local" class="form-control form-control-lg border-primary @error('sale_date') is-invalid @enderror"
                                           wire:model.live="sale_date">
                                    @error('sale_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold text-muted small">{{ __('Invoice NO') }} <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-lg @error('invoice_no') is-invalid @enderror"
                                           wire:model.live.debounce.500ms="invoice_no"
                                           placeholder="INV-{{ now()->format('ymd') }}-XXXX">
                                    @error('invoice_no') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Items Section -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center py-3">
                            <h6 class="mb-0 fw-semibold text-dark">
                                <i class="fas fa-boxes-stacked me-2 text-primary"></i>{{ __('Sale Items') }}
                            </h6>
                            <button type="button" class="btn btn-primary btn-sm px-3" wire:click="addItem">
                                <i class="fas fa-plus me-1"></i> {{ __('Add Item') }}
                            </button>
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
                                            <th width="60"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($items as $index => $item)
                                            <tr wire:key="item-{{ $index }}">
                                                <td class="ps-4">
                                                    <select class="form-select @error("items.$index.product_id") is-invalid @enderror"
                                                            wire:model.live="items.{{ $index }}.product_id">
                                                        <option value="">— {{ __('Choose...') }} —</option>
                                                        @foreach($products as $p)
                                                            <option value="{{ $p->id }}">{{ $p->name }} • {{ $p->code }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error("items.$index.product_id") <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                                </td>
                                                <td>
                                                    <input type="number" step="0.01" min="0.001" class="form-control text-end @error("items.$index.qty") is-invalid @enderror"
                                                           wire:model.live.debounce.400ms="items.{{ $index }}.qty"
                                                           placeholder="1.00">
                                                    @error("items.$index.qty") <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                                </td>
                                                <td>
                                                    <input type="number" step="0.01" min="0" class="form-control text-end @error("items.$index.unit_price") is-invalid @enderror"
                                                           wire:model.live.debounce.400ms="items.{{ $index }}.unit_price"
                                                           placeholder="0.00">
                                                    @error("items.$index.unit_price") <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                                </td>
                                                <td>
                                                    <input type="number" step="0.01" class="form-control text-end @error("items.$index.discount") is-invalid @enderror"
                                                           wire:model.live.debounce.400ms="items.{{ $index }}.discount"
                                                           placeholder="0.00">
                                                    @error("items.$index.discount") <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                                </td>
                                                <td class="text-end fw-medium text-dark">
                                                    {{ number_format($item['total'] ?? 0, 2) }}
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
                                                    {{ __('No items added yet') }}.<br>
                                                    {{ __('Click Add Item to start.') }}
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
                                              placeholder="Customer request, special instructions, internal memo..."></textarea>
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
                                            <span class="fw-medium">{{ number_format($subtotal ?? 0, 2) }}</span>
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
                                            <span class="text-primary">{{ number_format($total ?? 0, 2) }}</span>
                                        </div>

                                        <div class="input-group input-group-sm mb-2">
                                            <span class="input-group-text">{{ __('Paid Amount') }}</span>
                                            <input type="number" step="0.01" class="form-control text-end" wire:model.live.debounce.500ms="paid_amount">
                                        </div>

                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <span>{{ __('Change') }}</span>
                                            <span class="fw-medium">{{ number_format($change_amount ?? 0, 2) }}</span>
                                        </div>

                                        <div class="d-flex justify-content-between align-items-center fw-bold text-danger fs-5">
                                            <span>{{ __('Amount Due') }}</span>
                                            <span>{{ number_format($due_amount ?? 0, 2) }}</span>
                                        </div>

                                        <!-- Mobile save button -->
                                        <div class="mt-4 text-end d-lg-none">
                                            <button type="submit" class="btn btn-primary px-5 py-3 fw-semibold" wire:loading.attr="disabled">
                                                <span wire:loading.remove><i class="fas fa-save me-2"></i> {{ __('Save') }}</span>
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
                            <i class="fas fa-check-circle me-2"></i> {{ __('Create') }}
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
    Livewire.on('open-create-sale', () => {
        const modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('createSaleModal'));
        if (modal) modal.show();
    });

    Livewire.on('close-create-sale', () => {
        const modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('createSaleModal'));
        if (modal) modal.hide();
    });
});
</script>