<div>
    <div class="modal fade" id="openModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content rounded-4 shadow-lg border-0">
                <div class="modal-header bg-light border-bottom-0 rounded-top-4 px-4 py-3">
                   <h4 class="modal-title fw-bold" id="addUserModalLabel" style="color:black">
                        <i class="fas fa-key me-2"></i> {{ __("Change password") }} 
                        <span class="text-secondary">{{ Auth::user()->name }}</span>
                    </h4> 
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit="changePassword" autocomplete="off">
                    <div class="modal-body bg-white rounded-bottom-4 px-4 py-4">
                        <div class="row g-3">  
                            <div class="col-md-12">
                                <label class="form-label fw-semibold">
                                    {{ __("Confirm old password") }} <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <input type="text" class="form-control @error('oldPassword') is-invalid @enderror" wire:model="oldPassword" placeholder="{{ __('Enter ') . __('Confirm old password') }}">
                                    <button type="button" wire:click="checkPassword" wire:loading.attr="disabled" class="btn transition-all {{ $isMatch === true ? 'btn-primary' : '' }} {{ $isMatch === false ? 'btn-danger' : 'btn-outline-secondary' }}">
                                        <span wire:loading>
                                            <i class="fas fa-spinner fa-spin"></i>
                                        </span> 
                                        <span wire:loading.remove>
                                            @if ($isMatch === true)
                                                <i class="fas fa-check-circle animate-success"></i>
                                            @elseif ($isMatch === false)
                                                <i class="fas fa-times-circle animate-error"></i>
                                            @else
                                                <i class="far fa-check-circle"></i>
                                            @endif
                                        </span> 
                                    </button>
                                    @error('oldPassword')
                                        <div class="invalid-feedback d-block">{{ __($message) }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label fw-semibold">{{__("New Password")}} <span class="text-danger">*</span></label> 
                                <input type="text" class="form-control @error('newPassword') is-invalid @enderror" wire:model="newPassword" placeholder="{{__('Enter ')}}{{ __('New Password') }}">
                                @error('newPassword')
                                    <div class="invalid-feedback d-block">{{ __($message) }}</div>
                                @enderror 
                            </div>
                            <div class="col-md-12">
                                <label class="form-label fw-semibold">{{__("Confirm Password")}} <span class="text-danger">*</span></label> 
                                <input type="text" class="form-control @error('newPassword_confirmation') is-invalid @enderror" wire:model="newPassword_confirmation" placeholder="{{__('Enter ')}}{{ __('Confirm Password') }}">
                                @error('newPassword_confirmation')
                                    <div class="invalid-feedback d-block">{{ __($message) }}</div>
                                @enderror 
                            </div> 
                        </div>
                    </div>
                    <div class="modal-footer bg-light border-top-0 rounded-bottom-4 px-4 py-3">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times me-1"></i> {{__('Close')}}
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="far fa-file-alt me-1"></i> {{__('Update')}}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <style>
        .transition-all {
            transition: all 0.3s ease-in-out;
        } 
        .animate-success {
            animation: pop 0.4s ease-in-out;
            color: #fff;
        } 
        .animate-error {
            animation: shake 0.4s ease-in-out;
            color: #fff;
        } 
        @keyframes pop {
            0% { transform: scale(0.5); opacity: 0; }
            80% { transform: scale(1.2); }
            100% { transform: scale(1); opacity: 1; }
        } 
        @keyframes shake {
            0% { transform: translateX(0); }
            25% { transform: translateX(-4px); }
            50% { transform: translateX(4px); }
            75% { transform: translateX(-4px); }
            100% { transform: translateX(0); }
        }
    </style>

</div>
