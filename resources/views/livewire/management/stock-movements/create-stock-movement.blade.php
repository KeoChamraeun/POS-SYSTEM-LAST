<div class="modal fade" id="createStockMovementModal" tabindex="-1" aria-labelledby="createStockMovementModalLabel" aria-hidden="true"
     wire:ignore.self data-bs-backdrop="static">
    <div class="modal-dialog modal-xl">
        <div class="modal-content rounded-4 shadow border-0">
            <div class="modal-header bg-primary rounded-top-4 px-4 py-3 border-bottom-0">
                <h5 class="modal-title fw-bold" id="createStockMovementModalLabel">
                    <i class="fas fa-plus-circle me-2 text-dark"></i>
                    {{ __('New Stock Adjustment') }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form wire:submit.prevent="save">
                <div class="modal-body px-4 pb-4">

                    <div class="row g-3">
                        <!-- Branch -->
                        <div class="col-md-6">
                            <label class="form-label">{{ __('Branch') }} <span class="text-danger">*</span></label>
                            <select class="form-select @error('branch_id') is-invalid @enderror" wire:model="branch_id">
                                <option value="">{{ __('Select branch...') }}</option>
                                @foreach ($branches as $branch)
                                    <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                @endforeach
                            </select>
                            @error('branch_id') <div class="invalid-feedback">{{ __($message) }}</div> @enderror
                        </div>

                        <!-- Product -->
                        <div class="col-md-6">
                            <label class="form-label">{{ __('Product') }} <span class="text-danger">*</span></label>
                            <select class="form-select @error('product_id') is-invalid @enderror" wire:model="product_id">
                                <option value="">{{ __('Select product...') }}</option>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}">
                                        {{ $product->name }} ({{ $product->code ?? '—' }})
                                    </option>
                                @endforeach
                            </select>
                            @error('product_id') <div class="invalid-feedback">{{ __($message) }}</div> @enderror
                        </div>

                        <!-- Type (fixed to adjustment in realistic mode) -->
                        <div class="col-md-4">
                            <label class="form-label">{{ __('Movement Type') }}</label>
                            <input type="text" class="form-control" value="Adjustment" disabled>
                            <input type="hidden" wire:model="type" value="adjustment">
                        </div>

                        <!-- Quantity In (Add) -->
                        <div class="col-md-4">
                            <label class="form-label">{{ __('Add Quantity') }} <small class="text-muted">(positive number)</small></label>
                            <input type="number" step="0.01" min="0" class="form-control @error('qty_in') is-invalid @enderror"
                                   wire:model.debounce.500ms="qty_in" placeholder="0.00">
                            @error('qty_in') <div class="invalid-feedback">{{ __($message) }}</div> @enderror
                        </div>

                        <!-- Quantity Out (Remove) -->
                        <div class="col-md-4">
                            <label class="form-label">{{ __('Remove Quantity') }} <small class="text-muted">(positive number)</small></label>
                            <input type="number" step="0.01" min="0" class="form-control @error('qty_out') is-invalid @enderror"
                                   wire:model.debounce.500ms="qty_out" placeholder="0.00">
                            @error('qty_out') <div class="invalid-feedback">{{ __($message) }}</div> @enderror
                        </div>

                        <!-- Note / Reason -->
                        <div class="col-12">
                            <label class="form-label">{{ __('Reason / Note') }}</label>
                            <textarea class="form-control @error('note') is-invalid @enderror" rows="3"
                                      wire:model="note" placeholder="e.g. Physical count correction, damaged goods, initial stock..."></textarea>
                            @error('note') <div class="invalid-feedback">{{ __($message) }}</div> @enderror
                        </div>
                    </div>

                    <div class="mt-4 alert alert-info small">
                        <i class="fas fa-info-circle me-2"></i>
                        {{ __('Current stock will be updated automatically after saving.') }}
                    </div>

                </div>

                <div class="modal-footer bg-light rounded-bottom-4 px-4 py-3 border-top-0">
                    <button type="button" class="btn btn-outline-secondary px-4" data-bs-dismiss="modal">
                        {{ __('Cancel') }}
                    </button>
                    <button type="submit" class="btn btn-primary px-5" wire:loading.attr="disabled">
                        <span wire:loading.remove>
                            <i class="fas fa-save me-2"></i>{{ __('Save') }}
                        </span>
                        <span wire:loading>
                            <i class="fas fa-spinner fa-spin me-2"></i>{{ __('Saving...') }}
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('livewire:init', () => {
    Livewire.on('open-create-stock-movement', () => {
        bootstrap.Modal.getOrCreateInstance(document.getElementById('createStockMovementModal'))?.show();
    });

    Livewire.on('close-create-stock-movement', () => {
        bootstrap.Modal.getOrCreateInstance(document.getElementById('createStockMovementModal'))?.hide();
    });
});
</script>