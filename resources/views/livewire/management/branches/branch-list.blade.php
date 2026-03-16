<div class="container-fluid">
    <div class="row align-items-center g-3 mb-4">
        <div class="col-md-6">
            <h3 class="mb-0 fw-bold text-dark">
                <i class="fas fa-users me-2" style="color: #5AC559"></i>
                {{ __('Branches List') }}
            </h3>
        </div>
        <div class="col-md-6 text-md-end">
            <button type="button" class="btn btn-primary" wire:click="openCreateBranchModal">
                <i class="fas fa-plus me-2"></i>
                {{ __('New Branches') }}
            </button>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-header pb-2">
            <div class="row g-3">
                <div class="col-md-4 col-lg-3">
                    <label class="form-label text-muted mb-1">{{ __('Search') }}</label>
                    <input type="search" class="form-control" wire:model.live.debounce.400ms="search"
                           placeholder="{{ __('Search name, code, phone, email...') }}">
                </div>
            </div>
        </div>

        <div class="card-body p-0">
            <div wire:loading wire:target="search">
                <div class="position-absolute top-0 start-0 w-100 h-100 bg-white bg-opacity-75 d-flex flex-column align-items-center justify-content-center z-3">
                    <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                        <span class="visually-hidden">{{ __('Loading...') }}</span>
                    </div>
                    <p class="mt-3 text-muted">{{ __('Loading branches...') }}</p>
                </div>
            </div>

            <div class="table-responsive" wire:loading.remove wire:target="search">
                <table class="table table-hover table-striped align-middle mb-0">
                    <thead class="table-light">
                    <tr>
                        <th class="text-center" style="width:70px;">No.</th>
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Code') }}</th>
                        <th>{{ __('Phone') }}</th>
                        <th>{{ __('Email') }}</th>
                        <th>{{ __('Address') }}</th>
                        <th>{{ __('Status') }}</th>
                        <th class="text-center">{{ __('Action') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($branches as $index => $branch)
                        <tr>
                            <td class="text-center">{{ $branches->firstItem() + $index }}</td>
                            <td>{{ $branch->name }}</td>
                            <td><code>{{ $branch->code }}</code></td>
                            <td>{{ $branch->phone ?: '—' }}</td>
                            <td>{{ $branch->email ?: '—' }}</td>
                            <td>{{ $branch->address ?: '—' }}</td>
                            <td>
                                @if($branch->status)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-secondary">Inactive</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <button 
                                    class="btn btn-sm btn-outline-primary"
                                    wire:click="editBranch({{ $branch->id }})"
                                    title="{{ __('Edit Branch') }}">
                                    <i class="fas fa-edit"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-5 text-muted">
                                {{ __('No branches found.') }}
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            <div class="card-footer d-flex justify-content-between align-items-center">
                <div>
                    {{ $branches->links('vendor.pagination.bootstrap-5') }}
                </div>
                <small class="text-muted">
                    {{ __('Showing') }} {{ $branches->count() }} {{ __('of') }} {{ $branches->total() }}
                </small>
            </div>
        </div>
    </div>

    <!-- Important: both modals must be included -->
    <livewire:management.branches.create-branch />
    <livewire:management.branches.update-branch />
</div>