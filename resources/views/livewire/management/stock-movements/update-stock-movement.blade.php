<div class="modal fade" id="editStockMovementModal" tabindex="-1" aria-labelledby="editStockMovementModalLabel" aria-hidden="true"
     wire:ignore.self data-bs-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content rounded-4 shadow border-0">
            <div class="modal-header bg-light rounded-top-4 px-4 py-3 border-bottom-0">
                <h5 class="modal-title fw-bold" id="editStockMovementModalLabel">
                    <i class="fas fa-edit me-2 text-warning"></i>
                    {{ __('Edit Stock Movement') }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body px-4 pb-4">
                <div class="alert alert-warning small mb-4">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    {{ __('Only the note can be edited. Quantity and type are locked for audit purposes.') }}
                </div>

                <!-- Read-only info -->
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">{{ __('Date') }}</label>
                        <p class="form-control-static">{{ $movement?->created_at?->format('d M Y H:i') ?? '—' }}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">{{ __('Branch') }}</label>
                        <p class="form-control-static">{{ $movement?->branch?->name ?? '—' }}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">{{ __('Product') }}</label>
                        <p class="form-control-static">
                            {{ $movement?->product?->name ?? '—' }}
                            <small class="d-block text-muted">{{ $movement?->product?->code ?? '' }}</small>
                        </p>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">{{ __('Type') }}</label>
                        <p class="form-control-static">
                            <span class="badge bg-secondary">{{ ucfirst($movement?->type ?? '—') }}</span>
                        </p>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">{{ __('In') }}</label>
                        <p class="form-control-static text-success fw-bold">{{ number_format($movement?->qty_in ?? 0, 2) }}</p>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">{{ __('Out') }}</label>
                        <p class="form-control-static text-danger fw-bold">{{ number_format($movement?->qty_out ?? 0, 2) }}</p>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">{{ __('Balance') }}</label>
                        <p class="form-control-static fw-bold">{{ number_format($movement?->balance_after ?? 0, 2) }}</p>
                    </div>
                </div>

                <!-- Editable field: Note -->
                <div class="mb-3">
                    <label class="form-label">{{ __('Note') }}</label>
                    <textarea class="form-control @error('note') is-invalid @enderror" rows="4"
                              wire:model="note" placeholder="Update reason or additional information..."></textarea>
                    @error('note') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="modal-footer bg-light rounded-bottom-4 px-4 py-3 border-top-0">
                <button type="button" class="btn btn-outline-secondary px-4" data-bs-dismiss="modal">
                    {{ __('Cancel') }}
                </button>
                <button type="button" class="btn btn-warning px-5" wire:click="update" wire:loading.attr="disabled">
                    <span wire:loading.remove>
                        <i class="far fa-save me-2"></i>{{ __('Update') }}
                    </span>
                    <span wire:loading>
                        <i class="fas fa-spinner fa-spin me-2"></i>{{ __('Saving...') }}
                    </span>
                </button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('livewire:init', () => {
    Livewire.on('open-edit-stock-movement', () => {
        bootstrap.Modal.getOrCreateInstance(document.getElementById('editStockMovementModal'))?.show();
    });

    Livewire.on('close-edit-stock-movement', () => {
        bootstrap.Modal.getOrCreateInstance(document.getElementById('editStockMovementModal'))?.hide();
    });
});
</script>