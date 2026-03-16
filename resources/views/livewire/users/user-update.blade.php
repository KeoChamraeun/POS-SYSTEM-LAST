<div>
    <div class="modal fade" id="updateUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true" wire:ignore.self data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-lg">
            <div class="modal-content rounded-4 shadow-lg border-0"> 
                <div class="modal-header bg-light border-bottom-0 rounded-top-4 px-4 py-3">
                    <h4 class="modal-title fw-bold text-dark" id="addUserModalLabel">
                        <i class="fa-solid fa-pen-to-square me-2"></i> {{ __('Update User') }}
                    </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div> 
                <form wire:submit.prevent="update" autocomplete="off">
                    <div class="modal-body bg-white rounded-bottom-4 px-4 py-4">   
                        <div class="row g-5"> 
                            <div class="col-lg-4 d-flex flex-column align-items-center border-end">
                                <div class="mb-4 w-100 text-center">
                                    <label class="form-label fw-semibold">{{ __('Profile Image') }}</label>
                                    <input type="file" class="form-control mb-2" wire:model="img" accept="image/*">
                                    @error('img') <div class="small text-danger mt-1">{{ $message }}</div> @enderror
                                    
                                    <div class="rounded-circle overflow-hidden border shadow-sm mx-auto" style="width:120px; height:120px; background:#f8f9fa;">
                                        @if ($img)
                                            <img src="{{ $img->temporaryUrl() }}" alt="Profile Preview" class="img-fluid h-100 w-100 object-fit-cover">
                                        @else
                                            <img src="{{ asset($imgStore)}}" alt="Profile Preview" class="img-fluid h-100 w-100 object-fit-cover">
                                        @endif
                                    </div>
                                    <div class="mt-2 small text-muted">JPG, PNG, or GIF. Max 2MB.</div>
                                </div>
                            </div> 
                            <div class="col-lg-8">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">{{ __('First Name') }} <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('first') is-invalid @enderror" wire:model="first" placeholder="{{__('Enter')}}{{ __('First Name') }}">
                                        @error('first') <div class="small text-danger mt-1">{{ __($message) }}</div> @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">{{ __('Last Name') }} <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('last') is-invalid @enderror" wire:model="last" placeholder="{{__('Enter')}}{{ __('Last Name') }}">
                                        @error('last') <div class="small text-danger mt-1">{{ __($message) }}</div> @enderror
                                    </div>

                                    <div class="col-md-12 mt-3">
                                        <label class="form-label fw-semibold">{{ __('Username') }} <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('username') is-invalid @enderror" wire:model="username" placeholder="{{__('Enter')}}{{ __('Username') }}">
                                        @error('username') <div class="small text-danger mt-1">{{ __($message) }}</div> @enderror
                                    </div> 

                                    <div class="col-md-6 mt-3">
                                        <label class="form-label fw-semibold">{{ __('Role') }} <span class="text-danger">*</span></label>
                                        <select class="form-select @error('role_id') is-invalid @enderror" wire:model.live="role_id">
                                            <option value="">{{ __('Choose...') }}</option>
                                            @foreach($roles as $role)
                                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('role_id') <div class="small text-danger mt-1">{{ __($message) }}</div> @enderror
                                    </div>

                                    <div class="col-md-12 mt-3">
                                        <label class="form-label fw-semibold">{{ __('Phone') }}</label>
                                        <input type="text" class="form-control @error('phone') is-invalid @enderror" wire:model="phone" placeholder="{{__('Enter ')}}{{ __('Phone') }}">
                                        @error('phone') <div class="small text-danger mt-1">{{ __($message) }}</div> @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 
                    <div class="modal-footer bg-light border-top-0 rounded-bottom-4 px-4 py-3">
                        <button type="button" class="btn btn-outline-secondary px-4" data-bs-dismiss="modal">
                            <i class="fas fa-times me-1"></i> {{ __('Close') }}
                        </button>
                        <button type="submit" class="btn btn-primary px-5">
                            <i class="far fa-file-alt me-1"></i> {{ __('Save') }}
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
