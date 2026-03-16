<div class="modal fade" id="createCategoryModal" tabindex="-1" aria-labelledby="createCategoryModalLabel" aria-hidden="true"
     wire:ignore.self data-bs-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content rounded-4 shadow border-0">
            <div class="modal-header bg-primary rounded-top-4 px-4 py-3 border-bottom-0">
                <h5 class="modal-title fw-bold" id="createCategoryModalLabel">
                    <i class="fas fa-tag me-2 text-dark"></i>
                    {{ __('New Category') }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form wire:submit.prevent="save">
                <div class="modal-body px-4 pb-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">{{ __('Category Name') }} <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                   wire:model="name" placeholder="Electronics, Clothing, Accessories...">
                            @error('name') <div class="invalid-feedback">{{ __($message) }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">{{ __('Category Code') }} <span class="text-danger">*</span></label>
                            <input type="text" class="form-control text-uppercase @error('code') is-invalid @enderror"
                                   wire:model.debounce.500ms="code" placeholder="ELEC, CLTH, ACCS...">
                            @error('code') <div class="invalid-feedback">{{ __($message) }}</div> @enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label">{{ __('Description') }}</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" rows="4"
                                      wire:model="description" placeholder="Brief description of this category..."></textarea>
                            @error('description') <div class="invalid-feedback">{{ __($message) }}</div> @enderror
                        </div>

                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" wire:model="status" id="statusActive">
                                <label class="form-check-label" for="statusActive">
                                    {{ __('Active / Visible') }}
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
                            <i class="far fa-save me-2"></i>{{ __('Save') }}
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
    Livewire.on('open-create-category-modal', () => {
        bootstrap.Modal.getOrCreateInstance(document.getElementById('createCategoryModal'))?.show();
    });

    Livewire.on('close-create-category-modal', () => {
        bootstrap.Modal.getOrCreateInstance(document.getElementById('createCategoryModal'))?.hide();
    });
});
</script>