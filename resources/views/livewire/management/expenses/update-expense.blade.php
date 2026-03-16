<div class="modal fade" id="editExpenseModal" tabindex="-1" aria-hidden="true" wire:ignore.self data-bs-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content rounded-4 shadow border-0">
            <div class="modal-header bg-primary text-white rounded-top-4">
                <h5 class="modal-title fw-bold">
                    <i class="fas fa-edit me-2"></i> Edit Expense
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <form wire:submit.prevent="update">
                <div class="modal-body">
                    <div class="row g-3">

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Branch <span class="text-danger">*</span></label>
                            <select class="form-select @error('branch_id') is-invalid @enderror" wire:model="branch_id">
                                <option value="">— Select branch —</option>
                                @foreach($branches as $b)
                                    <option value="{{ $b->id }}">{{ $b->name }}</option>
                                @endforeach
                            </select>
                            @error('branch_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control @error('expense_date') is-invalid @enderror"
                                   wire:model="expense_date">
                            @error('expense_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-bold">Title / Description <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror"
                                   wire:model="title">
                            @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Category</label>
                            <input type="text" class="form-control @error('category') is-invalid @enderror"
                                   wire:model="category" placeholder="Utilities, Rent, Salary...">
                            @error('category') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Amount <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" class="form-control @error('amount') is-invalid @enderror"
                                   wire:model="amount">
                            @error('amount') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-bold">Note / Remark</label>
                            <textarea class="form-control @error('note') is-invalid @enderror" rows="3"
                                      wire:model="note"></textarea>
                            @error('note') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                    </div>
                </div>

                <div class="modal-footer bg-light rounded-bottom-4">
                    <button type="button" class="btn btn-outline-secondary px-4" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary px-5" wire:loading.attr="disabled">
                        <span wire:loading.remove>
                            <i class="fas fa-save me-2"></i> Update Expense
                        </span>
                        <span wire:loading>
                            <i class="fas fa-spinner fa-spin me-2"></i> Updating...
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('livewire:init', () => {
    Livewire.on('show-edit-expense-modal', () => {
        bootstrap.Modal.getOrCreateInstance(document.getElementById('editExpenseModal'))?.show();
    });

    Livewire.on('close-edit-expense', () => {
        bootstrap.Modal.getOrCreateInstance(document.getElementById('editExpenseModal'))?.hide();
    });
});
</script>