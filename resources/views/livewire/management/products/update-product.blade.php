<div class="modal fade" id="updateProductModal" tabindex="-1" aria-labelledby="updateProductModalLabel" wire:ignore.self data-bs-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content rounded-4 shadow">
            <div class="modal-header bg-primary rounded-top-4 px-4 py-3 border-bottom-0">
                <h5 class="modal-title fw-bold" id="updateProductModalLabel">
                    <i class="fas fa-edit me-2 text-dark"></i> {{ __('Edit Product') }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form wire:submit.prevent="update">
                <div class="modal-body px-4 pb-4">
                    <div class="row g-3">

                        <div class="col-md-8">
                            <label class="form-label">{{ __('Product Name') }} <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                   wire:model="name" placeholder="e.g. Samsung Galaxy S23">
                            @error('name') <div class="invalid-feedback">{{ __($message) }}</div> @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">{{ __('Code') }} <span class="text-danger">*</span></label>
                            <input type="text" class="form-control text-uppercase @error('code') is-invalid @enderror"
                                   wire:model.debounce.500ms="code" placeholder="S23BLK">
                            @error('code') <div class="invalid-feedback">{{ __($message) }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">{{ __('Barcode') }} (optional)</label>
                            <input type="text" class="form-control @error('barcode') is-invalid @enderror"
                                   wire:model="barcode" placeholder="8801234567890">
                            @error('barcode') <div class="invalid-feedback">{{ __($message) }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">{{ __('Unit') }} <span class="text-danger">*</span></label>
                            <select class="form-select @error('unit_id') is-invalid @enderror" wire:model="unit_id">
                                <option value="">{{ __('Select unit') }}</option>
                                @foreach ($units as $unit)
                                    <option value="{{ $unit->id }}">{{ $unit->name }} ({{ $unit->symbol ?? $unit->name }})</option>
                                @endforeach
                            </select>
                            @error('unit_id') <div class="invalid-feedback">{{ __($message) }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">{{ __('Category') }}</label>
                            <select class="form-select @error('category_id') is-invalid @enderror" wire:model="category_id">
                                <option value="">{{ __('No category') }}</option>
                                @foreach ($categories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id') <div class="invalid-feedback">{{ __($message) }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">{{ __('Brand') }}</label>
                            <select class="form-select @error('brand_id') is-invalid @enderror" wire:model="brand_id">
                                <option value="">{{ __('No brand') }}</option>
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                @endforeach
                            </select>
                            @error('brand_id') <div class="invalid-feedback">{{ __($message) }}</div> @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">{{ __('Cost Price') }} <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" class="form-control @error('cost_price') is-invalid @enderror"
                                   wire:model.debounce.500ms="cost_price" placeholder="0.00">
                            @error('cost_price') <div class="invalid-feedback">{{ __($message) }}</div> @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">{{ __('Selling Price') }} <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" class="form-control @error('selling_price') is-invalid @enderror"
                                   wire:model.debounce.500ms="selling_price" placeholder="0.00">
                            @error('selling_price') <div class="invalid-feedback">{{ __($message) }}</div> @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">{{ __('Alert Quantity') }} <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" class="form-control @error('alert_qty') is-invalid @enderror"
                                   wire:model="alert_qty" placeholder="10.00">
                            @error('alert_qty') <div class="invalid-feedback">{{ __($message) }}</div> @enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label">{{ __('Description') }}</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" rows="3"
                                      wire:model="description" placeholder="Key features, specifications..."></textarea>
                            @error('description') <div class="invalid-feedback">{{ __($message) }}</div> @enderror
                        </div>

                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" wire:model="status" id="statusActiveEdit">
                                <label class="form-check-label" for="statusActiveEdit">
                                    {{ __('Active') }}
                                </label>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="modal-footer bg-light rounded-bottom-4 px-4 py-3 border-top-0">
                    <button type="button" class="btn btn-outline-secondary px-4" data-bs-dismiss="modal">
                        {{ __('Cancel') }}
                    </button>
                    <button type="submit" class="btn btn-primary px-5" wire:loading.attr="disabled">
                        <span wire:loading.remove>
                            <i class="fas fa-save me-2"></i> {{ __('Update') }}
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
    Livewire.on('open-update-product-modal', () => {
        bootstrap.Modal.getOrCreateInstance(document.getElementById('updateProductModal'))?.show();
    });

    Livewire.on('close-update-product-modal', () => {
        bootstrap.Modal.getOrCreateInstance(document.getElementById('updateProductModal'))?.hide();
    });
});
</script>