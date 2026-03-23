<div class="container-fluid">
    <div class="row align-items-center g-3 mb-4">
        <div class="col-md-6">
            <h3 class="mb-0 fw-bold text-dark">
                <i class="fas fa-hand-holding-dollar me-2 text-primary"></i>
                {{ __('Expenses') }}
            </h3>
        </div>
        <div class="col-md-6 text-md-end">
            <button type="button" class="btn btn-primary" wire:click="openCreateExpense">
                <i class="fas fa-plus me-2"></i> {{ __('New Expense') }}
            </button>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-header">
            <input type="search" class="form-control w-50" placeholder="{{ __('Search...') }}"
                   wire:model.live.debounce.500ms="search">
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="text-center">#</th>
                            <th>{{ __('Date') }}</th>
                            <th>{{ __('Date') }}</th>
                            <th>{{ __('Category') }}</th>
                            <th class="text-end">{{ __('Amount') }}</th>
                            <th>{{ __('Branch') }}</th>
                            <th>{{ __('Created By') }}</th>
                            <th>{{ __('Note') }}</th>
                            <th class="text-center">{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($expenses as $index => $expense)
                            <tr>
                                <td class="text-center">{{ $expenses->firstItem() + $index }}</td>
                                <td>{{ $expense->expense_date->format('d M Y') }}</td>
                                <td class="fw-medium">{{ $expense->title }}</td>
                                <td>
                                    @if($expense->category)
                                        <span class="badge bg-secondary">{{ $expense->category }}</span>
                                    @else
                                        —
                                    @endif
                                </td>
                                <td class="text-end fw-bold text-danger">
                                    {{ number_format($expense->amount, 2) }}
                                </td>
                                <td>{{ $expense->branch?->name ?? '—' }}</td>
                                <td>{{ $expense->created_by_name }}</td>
                                <td class="text-muted small">
                                    {{ Str::limit($expense->note ?? '', 40) }}
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-primary"
                                            wire:click="editExpense({{ $expense->id }})">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center py-5 text-muted">
                                    {{ __('No expenses found.') }}
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-footer d-flex justify-content-between align-items-center">
            {{ $expenses->links('vendor.pagination.bootstrap-5') }}
            <small class="text-muted">
                Showing {{ $expenses->count() }} of {{ $expenses->total() }}
            </small>
        </div>
    </div>

    <livewire:management.expenses.create-expense />
    <livewire:management.expenses.update-expense />
</div>