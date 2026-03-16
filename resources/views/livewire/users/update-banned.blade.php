<div>
    <div class="modal fade" id="updateBanned" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true" wire:ignore.self data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content rounded-4 shadow-lg border-0">
                <div class="modal-header bg-light border-bottom-0 rounded-top-4 px-4 py-3">
                    <h4 class="modal-title fw-bold" id="addUserModalLabel" style="color:black">
                        <i class="far fa-edit me-2"></i> {{__("Update Banned")}}
                    </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit="updateBanned" autocomplete="off">
                    <div class="modal-body bg-white rounded-bottom-4 px-4 py-4">
                        <div class="row g-3">  
                            <div class="col-md-12">
                                <label class="form-label fw-semibold">{{__("Banned")}} <span class="text-danger">*</span></label> 
                                <select class="form-select  @error('banned') is-invalid @enderror" wire:model.live="banned"> 
                                    <option value="0">{{__('Active')}}</option>
                                    <option value="1">{{__('Banned')}}</option> 
                                    </select>
                                @error('banned')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror 
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
        window.addEventListener('openUpdateBanned', () => {
            const modalElement = document.getElementById('updateBanned');
            const modal = new bootstrap.Modal(modalElement);
            modal.show(); 
            document.body.style.overflow = 'hidden';
            document.body.style.paddingRight = '0';
        });

        window.addEventListener('closeUpdateBanned', () => {
            const modalElement = document.getElementById('updateBanned');
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
            const modalElement = document.getElementById('updateBanned');
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