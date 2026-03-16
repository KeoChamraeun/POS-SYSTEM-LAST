<div class="container-fluid">
    <div class="row align-items-center g-3">
        <div class="row mt-2">
            <h5 class="text-bold"> {{__('Type Of Purchase')}} {{$type}}</h5>
            <div class="d-flex">
                <div class="form-check">
                    <input class="form-check-input" value="1" type="radio" wire:model="type" id="flexRadioDefault1">
                    <label class="form-check-label" for="flexRadioDefault1">
                        {{ __('Fixed Asset') }}
                    </label>
                </div>
                &nbsp; &nbsp;
                <div class="form-check">
                    <input class="form-check-input" value="0" type="radio" wire:model="type" id="flexRadioDefault2">
                    <label class="form-check-label" for="flexRadioDefault2">
                        {{ __('Expendable') }}
                    </label>
                </div>
            </div>
        </div>
        <div class="card">
            <form wire:submit.prevent="create_chart_account" autocomplete="off">
                <div class="modal-body bg-white rounded-bottom-4 px-1 py-3">
                    <div class="row g-5">
                        <div class="col-lg-12">
                            <div class="row g-3">
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <label class="form-label fw-semibold">{{ __('Purchased Date') }} <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        wire:model.live="purchase_date"
                                        placeholder="{{__('Enter')}}{{ __('Purchased Date') }}">
                                    @error('purchase_date') <div class="small text-danger mt-1">{{ __($message) }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <label class="form-label fw-semibold">{{ __('Purchased Date') }} <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        wire:model.live="purchase_date"
                                        placeholder="{{__('Enter')}}{{ __('Purchased Date') }}">
                                    @error('purchase_date') <div class="small text-danger mt-1">{{ __($message) }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <label class="form-label fw-semibold">{{ __('Purchased Date') }} <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        wire:model.live="purchase_date"
                                        placeholder="{{__('Enter')}}{{ __('Purchased Date') }}">
                                    @error('purchase_date') <div class="small text-danger mt-1">{{ __($message) }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="mb-3 d-flex justify-content-end">
                    <button type="button" class="btn btn-outline-secondary px-3" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i> {{ __('Close') }}
                    </button>
                    &nbsp;&nbsp;&nbsp;&nbsp;

                    <button type="submit" class="btn btn-primary px-3">
                        <i class="far fa-file-alt me-1"></i> {{ __('Save') }}
                    </button>
                </div> -->
            </form>
        </div>
    </div>
    <style>
    .custom-input {
        height: 56px !important;
        padding: 14px 48px 14px 16px !important;
        border-radius: 14px !important;
        border: 1.5px solid #d0d5dd !important;
        font-size: 15px;
    }

    .custom-input-icon {
        position: absolute;
        right: 16px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 18px;
        color: #667085;
        pointer-events: none;
    }

    .custom-input:focus {
        border-color: #f59e0b !important;
        box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.15) !important;
    }
    </style>
</div>