<div class="modal fade" id="createSupplierModal" tabindex="-1" aria-labelledby="createSupplierModalLabel" wire:ignore.self data-bs-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content rounded-4 shadow">
            <div class="modal-header bg-primary rounded-top-4 px-4 py-3 border-bottom-0">
                <h5 class="modal-title fw-bold" id="createSupplierModalLabel">
                    <i class="fas fa-truck-loading me-2 text-dark"></i> {{ __('New Supplier') }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form wire:submit.prevent="save">
                <div class="modal-body px-4 pb-4">
                    <div class="row g-3">

                        <div class="col-md-6">
                            <label class="form-label">{{ __('Contact Person / Supplier Name') }} <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                   wire:model="name" placeholder="Mr. Socheat">
                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">{{ __('Company Name') }}</label>
                            <input type="text" class="form-control @error('company_name') is-invalid @enderror"
                                   wire:model="company_name" placeholder="ABC Trading Co., Ltd">
                            @error('company_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">{{ __('Phone Number') }}</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                   wire:model="phone" placeholder="098 765 4321">
                            @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">{{ __('Email Address') }}</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                   wire:model="email" placeholder="socheat@abctrading.com">
                            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label">{{ __('Address') }}</label>
                            <textarea class="form-control @error('address') is-invalid @enderror" rows="2"
                                      wire:model="address" placeholder="Street 2004, Sangkat Toul Tom Poung..."></textarea>
                            @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label">{{ __('Note') }}</label>
                            <textarea class="form-control @error('note') is-invalid @enderror" rows="3"
                                      wire:model="note" placeholder="Payment term: 30 days, Preferred delivery time: morning..."></textarea>
                            @error('note') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" wire:model="status" id="statusActive">
                                <label class="form-check-label" for="statusActive">
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
    Livewire.on('open-create-supplier', () => {
        bootstrap.Modal.getOrCreateInstance(document.getElementById('createSupplierModal'))?.show();
    });
    Livewire.on('close-create-supplier', () => {
        bootstrap.Modal.getOrCreateInstance(document.getElementById('createSupplierModal'))?.hide();
    });
});
</script>