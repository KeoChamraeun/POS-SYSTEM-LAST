<div class="modal fade" id="createBrandModal" tabindex="-1" aria-labelledby="createBrandModalLabel" wire:ignore.self data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 shadow">
            <div class="modal-header bg-primary rounded-top-4 px-4 py-3 border-bottom-0">
                <h5 class="modal-title fw-bold" id="createBrandModalLabel">
                    <i class="fas fa-copyright me-2 text-dark"></i> {{ __('New Brand') }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form wire:submit.prevent="save">
                <div class="modal-body px-4 pb-4">

                    <div class="mb-3">
                        <label class="form-label">{{ __('Brand Name') }} <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                               wire:model="name" placeholder="Samsung, Apple, Nike...">
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">{{ __('Brand Code') }} (optional)</label>
                        <input type="text" class="form-control text-uppercase @error('code') is-invalid @enderror"
                               wire:model.debounce.500ms="code" placeholder="SAMS, APL, NKE">
                        @error('code') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        <small class="form-text text-muted">{{ __('Used for internal reference or quick search') }}</small>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" wire:model="status" id="statusCreate">
                        <label class="form-check-label" for="statusCreate">
                            {{ __('Active') }} {{ __('visible in product creation') }}
                        </label>
                    </div>

                </div>

                <div class="modal-footer bg-light rounded-bottom-4 px-4 py-3 border-top-0">
                    <button type="button" class="btn btn-outline-secondary px-4" data-bs-dismiss="modal">
                        {{ __('Cancel') }}
                    </button>
                    <button type="submit" class="btn btn-primary px-5" wire:loading.attr="disabled">
                        <span wire:loading.remove><i class="fas fa-save me-2"></i>{{ __('Save') }}</span>
                        <span wire:loading><i class="fas fa-spinner fa-spin me-2"></i>{{ __('Saving...') }}</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('livewire:init', () => {
    Livewire.on('open-create-brand', () => {
        bootstrap.Modal.getOrCreateInstance(document.getElementById('createBrandModal'))?.show();
    });
    Livewire.on('close-create-brand', () => {
        bootstrap.Modal.getOrCreateInstance(document.getElementById('createBrandModal'))?.hide();
    });
});
</script>