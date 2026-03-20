<div class="modal fade" id="createExpenseModal" tabindex="-1" aria-hidden="true" wire:ignore.self data-bs-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content rounded-4 shadow border-0">
            <div class="modal-header bg-primary text-white rounded-top-4">
                <h5 class="modal-title fw-bold">
                    <i class="fas fa-hand-holding-dollar me-2"></i> {{ __('Record New Expense') }}
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <form wire:submit.prevent="save">
                <div class="modal-body">
                    <div class="row g-3">

                        <div class="col-md-6">
                            <label class="form-label fw-bold">{{ __('Branch') }} <span class="text-danger">*</span></label>
                            <select class="form-select @error('branch_id') is-invalid @enderror" wire:model="branch_id">
                                <option value="">— {{ __('Choose') }} —</option>
                                @foreach($branches as $b)
                                    <option value="{{ $b->id }}">{{ $b->name }}</option>
                                @endforeach
                            </select>
                            @error('branch_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">{{ __('Date') }} <span class="text-danger">*</span></label>
                            <input type="date" class="form-control @error('expense_date') is-invalid @enderror"
                                   wire:model="expense_date">
                            @error('expense_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-bold">{{ __('Title / Description') }} <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror"
                                   wire:model="title" placeholder="Electricity bill, staff salary, marketing...">
                            @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">{{ __('Category') }}</label>
                            <input type="text" class="form-control @error('category') is-invalid @enderror"
                                   wire:model="category" placeholder="Utilities, Rent, Salary, Transport...">
                            @error('category') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">{{ __('Amount') }} ({{ strtoupper(config('app.currency', 'USD')) }}) <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" class="form-control @error('amount') is-invalid @enderror"
                                   wire:model="amount" placeholder="0.00">
                            @error('amount') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-bold">{{ __('Note') }}</label>
                            <textarea class="form-control @error('note') is-invalid @enderror" rows="3"
                                      wire:model="note" placeholder="Supplier name, invoice number, purpose..."></textarea>
                            @error('note') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                    </div>
                </div>

                <div class="modal-footer bg-light rounded-bottom-4">
                    <button type="button" class="btn btn-outline-secondary px-4" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                    <button type="submit" class="btn btn-primary px-5" wire:loading.attr="disabled">
                        <span wire:loading.remove>
                            <i class="fas fa-save me-2"></i> {{ __('Save') }}
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
    Livewire.on('open-create-expense', () => {
        bootstrap.Modal.getOrCreateInstance(document.getElementById('createExpenseModal'))?.show();
    });

    Livewire.on('close-create-expense', () => {
        bootstrap.Modal.getOrCreateInstance(document.getElementById('createExpenseModal'))?.hide();
    });
});
</script>