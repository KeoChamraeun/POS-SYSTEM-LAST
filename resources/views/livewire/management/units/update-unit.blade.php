<div class="modal fade" id="updateUnitModal" tabindex="-1" aria-labelledby="updateUnitModalLabel" wire:ignore.self data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 shadow">
            <div class="modal-header bg-primary rounded-top-4 px-4 py-3 border-bottom-0">
                <h5 class="modal-title fw-bold" id="updateUnitModalLabel">
                    <i class="fas fa-edit me-2 text-dark"></i> {{ __('Edit Unit') }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form wire:submit.prevent="update">
                <div class="modal-body px-4 pb-4">

                    <div class="mb-3">
                        <label class="form-label">{{ __('Unit Name') }} <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                               wire:model="name">
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">{{ __('Short Name / Abbreviation') }} <span class="text-danger">*</span></label>
                        <input type="text" class="form-control text-uppercase @error('short_name') is-invalid @enderror"
                               wire:model.debounce.500ms="short_name">
                        @error('short_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">{{ __('Symbol') }} (optional)</label>
                        <input type="text" class="form-control @error('symbol') is-invalid @enderror"
                               wire:model="symbol">
                        @error('symbol') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" wire:model="status" id="statusActiveEdit">
                        <label class="form-check-label" for="statusActiveEdit">
                            {{ __('Active') }}
                        </label>
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
    Livewire.on('open-update-unit-modal', () => {
        bootstrap.Modal.getOrCreateInstance(document.getElementById('updateUnitModal'))?.show();
    });
    Livewire.on('close-update-unit-modal', () => {
        bootstrap.Modal.getOrCreateInstance(document.getElementById('updateUnitModal'))?.hide();
    });
});
</script>