<div>
    <div class="modal fade" id="openResetPassword" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true" wire:ignore.self data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content rounded-4 shadow-lg border-0">
                <div class="modal-header bg-light border-bottom-0 rounded-top-4 px-4 py-3">
                    <h4 class="modal-title fw-bold" id="addUserModalLabel" style="color:black">
                        <i class="far fa-edit me-2"></i> {{__("Reset Password")}}
                    </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit="resetPassword" autocomplete="off">
                    <div class="modal-body bg-white rounded-bottom-4 px-4 py-4">
                        <div class="row g-3">  
                            <div class="col-md-12">
                                <label class="form-label fw-semibold">{{ __('Password') }} <span class="text-danger">*</span></label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" wire:model="password" placeholder="{{__('Enter ')}}{{ __('Password') }}">
                                @error('password') <div class="small text-danger mt-1">{{ __($message) }}</div> @enderror
                            </div> 
                            <div class="col-md-12">
                                <label class="form-label fw-semibold">{{ __('Confirm Password') }} <span class="text-danger">*</span></label>
                                <input type="password" class="form-control @error('confirm_password') is-invalid @enderror" wire:model.defer="confirm_password" placeholder="{{__('Enter ')}}{{ __('Confirm Password') }}">
                                @error('confirm_password') <div class="small text-danger mt-1">{{ __($message) }}</div> @enderror
                            </div> 
                        </div>
                    </div>
                    <div class="modal-footer bg-light border-top-0 rounded-bottom-4 px-4 py-3">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times me-1"></i> {{__('Close')}}
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="far fa-edit me-1"></i> {{__('Update')}}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div> 
    <script>
        window.addEventListener('openResetPasswordModal', () => {
            const modalElement = document.getElementById('openResetPassword');
            const modal = new bootstrap.Modal(modalElement);
            modal.show();

            // Ensure body overflow is hidden when modal is shown
            document.body.style.overflow = 'hidden';
            document.body.style.paddingRight = '0';
        });

        window.addEventListener('closeResetPasswordModal', () => {
            const modalElement = document.getElementById('openResetPassword');
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
            const modalElement = document.getElementById('openResetPassword');
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