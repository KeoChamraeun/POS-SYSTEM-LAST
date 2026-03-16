<div class="modal-body bg-white rounded-bottom-4 px-4 py-4">
    <div class="row g-3"> 
        <div class="col-md-6">
            <label class="form-label fw-semibold">{{__("City")}} <span class="text-danger">*</span></label>
            <select class="form-select @error('city_id') is-invalid @enderror" wire:model.live="city_id">
                <option value="">{{ __('Choose...') }}</option>
                @foreach($cities as $city)
                    <option value="{{ $city->id }}">{{ get_translation($city) }}</option>
                @endforeach
            </select>
            @error('city_id')
                <div class="invalid-feedback d-block">{{ __($message) }}</div>
            @enderror
        </div>
        <div class="col-md-6"> 
            <label class="form-label fw-semibold">{{__("District")}}</label>
            <select class="form-select @error('district_id') is-invalid @enderror" wire:model.live="district_id" wire:key="district-{{ $city_id }}">
                <option value="">{{ __('Choose...') }}</option>
                @foreach($districts as $district)
                    <option value="{{ $district->id }}">{{ get_translation($district) }}</option>
                @endforeach
            </select>
            @error('district_id')
                <div class="invalid-feedback d-block">{{ __($message) }}</div>
            @enderror
        </div>
        <div class="col-md-6">
            <label class="form-label fw-semibold">{{__("Commune")}}</label>
            <select class="form-select @error('commune_id') is-invalid @enderror" wire:model.live="commune_id" wire:key="commune-{{ $district_id }}">
                <option value="">{{ __('Choose...') }}</option>
                @foreach($communes as $commune)
                    <option value="{{ $commune->id }}">{{ get_translation($commune) }}</option>
                @endforeach
            </select>
            @error('commune_id')
                <div class="invalid-feedback d-block">{{ __($message) }}</div>
            @enderror
        </div>
        <div class="col-md-6">
            <label class="form-label fw-semibold">{{__("Village")}}</label>
            <select class="form-select @error('village_id') is-invalid @enderror" wire:model.live="village_id" wire:key="village-{{ $commune_id }}">
                <option value="">{{ __('Choose...') }}</option>
                @foreach($villages as $village)
                    <option value="{{ $village->id }}">{{ get_translation($village) }}</option>
                @endforeach
            </select>
            @error('village_id')
                <div class="invalid-feedback d-block">{{ __($message) }}</div>
            @enderror
        </div> 
        <div class="col-md-6">
            <label class="form-label fw-semibold">{{__("House No")}}</label>
            <input type="text" class="form-control @error('house_no') is-invalid @enderror" wire:model="house_no" placeholder="{{__('Enter ')}}{{ __('House No') }}">
            @error('house_no')
                <div class="invalid-feedback d-block">{{ __($message) }}</div>
            @enderror
        </div>
        <div class="col-md-6">
            <label class="form-label fw-semibold">{{__("Street No")}}</label>
            <input type="text" class="form-control @error('street_no') is-invalid @enderror" wire:model="street_no" placeholder="{{__('Enter ')}}{{ __('Street No') }}">
            @error('street_no')
                <div class="invalid-feedback d-block">{{ __($message) }}</div>
            @enderror
        </div>
    </div>
</div>