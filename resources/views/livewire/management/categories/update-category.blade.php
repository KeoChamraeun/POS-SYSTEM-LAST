<div class="modal fade" id="updateCategoryModal" tabindex="-1" aria-labelledby="updateCategoryModalLabel" aria-hidden="true"
     wire:ignore.self data-bs-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content rounded-4 shadow border-0">
            <div class="modal-header bg-primary rounded-top-4 px-4 py-3 border-bottom-0">
                <h5 class="modal-title fw-bold" id="updateCategoryModalLabel">
                    <i class="fas fa-edit me-2 text-dark"></i>
                    {{ __('Edit Category') }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form wire:submit.prevent="update">
                <div class="modal-body px-4 pb-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">{{ __('Category Name') }} <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                   wire:model="name" placeholder="Electronics, Clothing...">
                            @error('name') <div class="invalid-feedback">{{ __($message) }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">{{ __('Category Code') }} <span class="text-danger">*</span></label>
                            <input type="text" class="form-control text-uppercase @error('code') is-invalid @enderror"
                                   wire:model.debounce.500ms="code" placeholder="ELEC, CLTH...">
                            @error('code') <div class="invalid-feedback">{{ __($message) }}</div> @enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label">{{ __('Description') }}</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" rows="4"
                                      wire:model="description" placeholder="Brief description..."></textarea>
                            @error('description') <div class="invalid-feedback">{{ __($message) }}</div> @enderror
                        </div>

                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" wire:model="status" id="statusActiveEdit">
                                <label class="form-check-label" for="statusActiveEdit">
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
                            <i class="far fa-save me-2"></i>{{ __('Update') }}
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
    Livewire.on('show-update-category-modal', () => {
        bootstrap.Modal.getOrCreateInstance(document.getElementById('updateCategoryModal'))?.show();
    });

    Livewire.on('close-update-category-modal', () => {
        bootstrap.Modal.getOrCreateInstance(document.getElementById('updateCategoryModal'))?.hide();
    });
});
</script>