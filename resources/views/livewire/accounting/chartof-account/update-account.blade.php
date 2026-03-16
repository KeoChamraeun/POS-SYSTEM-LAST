<div wire:ignore.self class="modal fade" id="openUpdateModal" tabindex="-1" aria-labelledby="addUserModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content rounded-4 shadow-lg border-0">
            <div class="modal-header bg-light border-bottom-0 rounded-top-4 px-4 py-3">
                <h4 class="modal-title fw-bold text-dark" id="addUserModalLabel">
                    <i class="fas fa-plus me-2"></i> {{ __('New User') }}
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="update_chart_account" autocomplete="off">
                <div class="modal-body bg-white rounded-bottom-4 px-4 py-4">
                    <div class="row g-5">
                        <div class="col-lg-12">
                            <div class="row g-3">
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <label class="form-label fw-semibold">{{ __('Name') }} <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        wire:model.live="name" placeholder="{{__('Enter')}}{{ __('Name') }}">
                                    @error('name') <div class="small text-danger mt-1">{{ __($message) }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <label class="form-label fw-semibold">{{ __('Parent') }}</label>
                                    <select wire:model="parent_id" class="form-control form-select">
                                        <option value="">Choose</option>
                                        @foreach ($parent_accounts as $acc )
                                        <option value="{{$acc->id}}">{{$acc->code}} {{$acc->abbreviation}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <label class="form-label fw-semibold">{{ __('Code') }} <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('code') is-invalid @enderror"
                                        wire:model.live="code" placeholder="{{__('Enter')}}{{ __('Code') }}">
                                    @error('code') <div class="small text-danger mt-1">{{ __($message) }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <label class="form-label fw-semibold">{{ __('Abbreviation') }} </label>
                                    <input type="text" class="form-control" wire:model.defer="abbreviation"
                                        placeholder="{{__('Enter')}}{{ __('abbreviation') }}">
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <label class="form-label fw-semibold">{{ __('Description') }} </label>
                                    <textarea type="text" class="form-control" wire:model.defer="description"
                                        placeholder="{{__('Enter')}}{{ __('description') }}"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light border-top-0 rounded-bottom-4 px-2 py-3">
                    <button type="button" class="btn btn-outline-secondary px-4" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i> {{ __('Close') }}
                    </button>
                    <button type="submit" class="btn btn-primary px-3">
                        <i class="far fa-file-alt me-1"></i> {{ __('Save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>