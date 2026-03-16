<div>
    <div class="modal fade" id="openModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content rounded-4 shadow-lg border-0">
                <div class="modal-header bg-light border-bottom-0 rounded-top-4 px-4 py-3">
                    <h4 class="modal-title fw-bold" id="addUserModalLabel" style="color:black">
                        <i class="fas fa-plus me-2"></i> {{__("New Role")}}
                    </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit="createRole" autocomplete="off">
                    <div class="modal-body bg-white rounded-bottom-4 px-4 py-4">
                        <div class="row g-3"> 
                            <div class="col-md-12">
                                <label class="form-label fw-semibold">{{__("Role")}} <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="{{__("Enter ")}}{{__("Role")}}" wire:model="name"/>
                                @error('name')
                                    <div class="invalid-feedback d-block">{{ __($message) }}</div>
                                @enderror
                            </div>

                            <div class="col-md-12">
                                <label class="form-label fw-semibold">{{__("Status")}} <span class="text-danger">*</span></label> 
                                <select class="form-select  @error('status') is-invalid @enderror" wire:model="role_status">
                                    <option selected>{{__('Choose...')}}</option>
                                    <option value="0">{{__('Inactive')}}</option>
                                    <option value="1">{{__('Active')}}</option> 
                                    </select>
                                @error('des_kh')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror 
                            </div>
                            <div class="col-md-12">
                                <label class="form-label fw-semibold">{{__("Description")}}</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" placeholder="{{__("Enter ")}}{{__("Description")}}" rows="3" wire:model="description"></textarea>
                                @error('description')
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
                            <i class="far fa-file-alt me-1"></i> {{__('Save')}}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div> 
</div>