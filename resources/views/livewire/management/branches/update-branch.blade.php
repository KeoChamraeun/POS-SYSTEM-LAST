<div class="modal fade" id="updateBranchModal" tabindex="-1" aria-labelledby="updateBranchModalLabel" aria-hidden="true"
     wire:ignore.self data-bs-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content rounded-4 shadow border-0">
            <div class="modal-header bg-primary rounded-top-4 px-4 py-3 border-bottom-0">
                <h5 class="modal-title fw-bold" id="updateBranchModalLabel">
                    <i class="fas fa-edit me-2 text-dark"></i>
                    {{ __('Edit Branch') }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form wire:submit.prevent="update">
                <div class="modal-body px-4 pb-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">{{ __('Branch Name') }} <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                   wire:model="name" placeholder="Head Office, Phnom Penh Branch...">
                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">{{ __('Branch Code') }} <span class="text-danger">*</span></label>
                            <input type="text" class="form-control text-uppercase @error('code') is-invalid @enderror"
                                   wire:model.debounce.500ms="code" placeholder="PP01, SR02...">
                            @error('code') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">{{ __('Phone Number') }}</label>
                            <input type="tel" class="form-control @error('phone') is-invalid @enderror"
                                   wire:model="phone" placeholder="+855 12 345 678">
                            @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">{{ __('Email') }}</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                   wire:model="email" placeholder="info@branchname.com">
                            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label">{{ __('Address') }}</label>
                            <textarea class="form-control @error('address') is-invalid @enderror" rows="3"
                                      wire:model="address" placeholder="Street, Village, Commune..."></textarea>
                            @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
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
    Livewire.on('show-update-modal', () => {
        const modalEl = document.getElementById('updateBranchModal');
        if (modalEl) {
            bootstrap.Modal.getOrCreateInstance(modalEl)?.show();
        }
    });

    Livewire.on('close-update-modal', () => {
        const modalEl = document.getElementById('updateBranchModal');
        if (modalEl) {
            bootstrap.Modal.getOrCreateInstance(modalEl)?.hide();
        }
    });
});
</script>