<div>
    <div class="modal fade" id="updateUserModal" tabindex="-1" aria-labelledby="updateUserModalLabel" aria-hidden="true"
         wire:ignore.self data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content rounded-4 shadow border-0">

                <div class="modal-header bg-primary border-0 rounded-top-4 px-4 py-3">
                    <h5 class="modal-title fw-bold" id="updateUserModalLabel">
                        <i class="fas fa-user-edit me-2 text-dark"></i>
                        {{ __('Update User') }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form wire:submit.prevent="update" autocomplete="off">
                    <div class="modal-body px-4 py-4 bg-white">

                        <div class="row g-4">

                            <!-- Left - Profile Photo -->
                            <div class="col-lg-4">
                                <div class="card border shadow-sm text-center p-3">
                                    <label class="form-label fw-semibold mb-3">{{ __('Profile Picture') }}</label>

                                    <input type="file" class="form-control form-control-sm mb-3" wire:model="img"
                                           accept="image/jpeg,image/png,image/gif">

                                    @error('img') <div class="text-danger small mb-2">{{ $message }}</div> @enderror

                                    <div class="mx-auto rounded-circle overflow-hidden border bg-light"
                                         style="width: 140px; height: 140px;">
                                        <img src="{{ $img ? $img->temporaryUrl() : ($imgStore ? asset('storage/' . $imgStore) : asset('assets/icon/profile.png')) }}"
                                             alt="Profile preview" class="img-fluid object-fit-cover w-100 h-100">
                                    </div>

                                    <small class="text-muted mt-2 d-block">
                                        JPG, PNG, GIF • Max 2 MB
                                    </small>
                                </div>
                            </div>

                            <!-- Right - Form fields -->
                            <div class="col-lg-8">
                                <div class="row g-3">

                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">{{ __('First Name') }} <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('first') is-invalid @enderror"
                                               wire:model.debounce.500ms="first" placeholder="Sok">
                                        @error('first') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">{{ __('Last Name') }} <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('last') is-invalid @enderror"
                                               wire:model.debounce.500ms="last" placeholder="Keo">
                                        @error('last') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label fw-semibold">{{ __('Username') }} <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('username') is-invalid @enderror"
                                               wire:model.debounce.800ms="username" placeholder="sokkeo123">
                                        @error('username') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">{{ __('Role') }} <span class="text-danger">*</span></label>
                                        <select class="form-select @error('role_id') is-invalid @enderror" wire:model.live="role_id">
                                            <option value="">{{ __('Choose') }}</option>
                                            @foreach($roles as $role)
                                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('role_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">{{ __('Phone Number') }}</label>
                                        <input type="tel" class="form-control @error('phone') is-invalid @enderror"
                                               wire:model.debounce.500ms="phone" placeholder="012 345 678">
                                        @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>

                                    <!-- Branches -->
                                    <div class="col-12 mt-4">
                                        <label class="form-label fw-bold">{{ __('Assign Branches') }} <span class="text-danger">*</span></label>
                                        <small class="text-muted ms-2">(hold Ctrl/Cmd to select multiple)</small>

                                        <select class="form-select @error('branch_ids') is-invalid @enderror"
                                                wire:model="branch_ids" multiple style="height: 160px;">
                                            @foreach($branches as $branch)
                                                <option value="{{ $branch->id }}">
                                                    {{ $branch->name }} ({{ $branch->code }})
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('branch_ids')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Default branch selector -->
                                    @if(count($branch_ids) > 1)
                                        <div class="col-md-6 mt-3">
                                            <label class="form-label fw-semibold">{{ __('Default Branch') }}</label>
                                            <select class="form-select @error('default_branch_id') is-invalid @enderror"
                                                    wire:model="default_branch_id">
                                                <option value="">{{ __('Choose default branch...') }}</option>
                                                @foreach($branches->whereIn('id', $branch_ids) as $b)
                                                    <option value="{{ $b->id }}">{{ $b->name }} ({{ $b->code }})</option>
                                                @endforeach
                                            </select>
                                            @error('default_branch_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    @endif

                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="modal-footer bg-light border-0 rounded-bottom-4 px-4 py-3">
                        <button type="button" class="btn btn-outline-secondary px-4" data-bs-dismiss="modal">
                            <i class="fas fa-times me-1"></i> {{ __('Cancel') }}
                        </button>
                        <button type="submit" class="btn btn-primary px-5" wire:loading.attr="disabled">
                            <span wire:loading.remove>
                                <i class="fas fa-save me-1"></i> {{ __('Update User') }}
                            </span>
                            <span wire:loading>
                                <i class="fas fa-spinner fa-spin me-1"></i> {{ __('Saving...') }}
                            </span>
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script>
        window.addEventListener('openUpdateUser', () => {
            const modalElement = document.getElementById('updateUserModal');
            const modal = new bootstrap.Modal(modalElement);
            modal.show(); 
            document.body.style.overflow = 'hidden';
            document.body.style.paddingRight = '0';
        });

        window.addEventListener('closeUpdateUser', () => {
            const modalElement = document.getElementById('updateUserModal');
            const modal = bootstrap.Modal.getInstance(modalElement);
            if (modal) {
                modal.hide();
            }

            // Manually remove the backdrop and reset body styles
            const backdrop = document.querySelector('.modal-backdrop');
            if (backdrop) {
                backdrop.parentNode.removeChild(backdrop);
            }
            document.body.style.overflow = '';
            document.body.style.paddingRight = '';
            document.body.classList.remove('modal-open');
        });

        // Handle browser close button (X) and cancel button
        document.addEventListener('DOMContentLoaded', function() {
            const modalElement = document.getElementById('updateUserModal');
            if (modalElement) {
                modalElement.addEventListener('hidden.bs.modal', function () {
                    // Remove backdrop when modal is closed via any method
                    const backdrop = document.querySelector('.modal-backdrop');
                    if (backdrop) {
                        backdrop.parentNode.removeChild(backdrop);
                    }
                    document.body.style.overflow = '';
                    document.body.style.paddingRight = '';
                    document.body.classList.remove('modal-open');
                });
            }
        }); 
    </script>
</div>
