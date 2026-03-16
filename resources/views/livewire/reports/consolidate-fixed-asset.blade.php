<div class="container-fluid">
    <div class="d-flex justify-content-center align-items-center flex-column"> 
        <div class="d-flex align-items-center mb-2">
            <img src="{{ asset('assets/images/logo-sm.png') }}" alt="Small Logo" width="52" class="me-2">
            <img src="{{ asset('assets/images/logo.png') }}" alt="Main Logo" width="120">
        </div> 
        <h4 class="fw-bold text-center text-truncate mt-2"> {{__('Consolidate of Fixed Assets Report')}}</h4>
        <h5 class="fw-bold text-center text-muted mb-2">
            {{__('As at')}} {{ __(\Carbon\Carbon::parse($month)->format('F')) }} {{\Carbon\Carbon::parse($month)->format('Y')}} 
        </h5>
    </div>  
    <div class="card shadow-sm border-0 mt-4">
        <div class="card-header pb-2">
            <div class="row align-items-center g-3">
                <div class="col-md-3">
                    <label class="form-label text-muted mb-1">{{ __('Search') }}</label>
                    <input type="search" class="form-control" wire:model.live="search" placeholder="{{ __('Search...') }}">
                </div> 
                <div class="col-md-2">
                    <label class="form-label text-muted mb-1">{{ __('Select Month') }}</label>
                    <input type="month" class="form-control" wire:model.live="month">
                </div> 
                <div class="col-md-2">
                    <label class="form-label fw-semibold">{{ __('Account') }}</label>
                    <select class="form-select" wire:model.live="accountId">
                        <option value="">{{ __('All account') }}</option>
                        @foreach($chartAccount as $value)
                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                        @endforeach
                    </select>
                </div> 
                <div class="col-md-5 text-md-end d-flex justify-content-md-end align-items-end">
                    <button type="button" class="btn btn-outline-primary" wire:click="download">
                        <span wire:loading>
                            <i class="fas fa-spinner fa-spin"></i>
                            {{ __('In progress...') }}
                        </span>
                        <span wire:loading.remove>
                            <i class="fas fa-file-excel me-2"></i>
                            {{ __('Export as Excel') }}
                        </span>
                    </button>
                </div>
            </div> 
            <div class="center-div">
                <div wire:loading wire:target="search, accountId, month"
                    class="fixed inset-0 bg-opacity-60 flex flex-col items-center justify-center z-50">
                    <div class="spinner-border text-primary"
                        role="status"
                        style="width: 3rem; height: 3rem;">
                        <span class="visually-hidden">{{ __('Loading...') }}</span>
                    </div>
                    <p class="mt-3 text-gray-700 text-sm font-medium">{{ __('Loading...') }}</p>
                </div>
            </div> 
            <div class="table-responsive mt-4"  style="overflow-x: auto; overflow-y: hidden;" wire:loading.remove wire:target="search, accountId, month"> 
                <table class="table table-striped table-hover table-bordered border-secondary align-middle mb-0" style="min-width: 1800px;"> 
                    <thead class="table-light">
                        <tr>
                            <th class="text-center" style="position: sticky; left: 0; z-index: 2; width: 60px;">{{ __('No.') }}</th>
                            <th class="text-start">{{ __('Code') }}</th>
                            <th class="text-start">{{ __('Description') }}</th>
                            <th class="text-center">{{ __('Asset Type') }}</th>
                            <th class="text-center">{{ __('Username') }}</th>
                            <th class="text-center">{{ __('Class Code') }}</th>
                            <th class="text-center">{{ __('Class Name') }}</th>
                            <th class="text-center">{{ __('Location') }}</th>
                            <th class="text-center">{{ __('BMC') }}</th>
                            <th class="text-center">{{ __('Condition') }}</th>
                            <th class="text-center">{{ __('Vendor') }}</th>
                            <th class="text-center">{{ __('Useful Life') }}</th>
                            <th class="text-center">{{ __('Pur. Value') }}</th>
                            <th class="text-center">{{ __('Pur. Date') }}</th>
                        </tr>
                    </thead> 
                    <tbody>
                        @if (!count($summaryFixedAssets) > 0)
                            <tr>
                                <td colspan="14"
                                    class="text-center fw-semibold text-danger py-4">
                                    <div class="d-flex flex-column align-items-center justify-content-center">
                                        <lord-icon
                                            src="https://cdn.lordicon.com/wjyqkiew.json"
                                            trigger="loop"
                                            delay="2000"
                                            colors="primary:#d97706,secondary:#eab308"
                                            style="width:100px; height:100px">
                                        </lord-icon>
                                        <span class="mt-2">{{ __('No record found!') }}</span>
                                    </div>
                                </td>
                            </tr>
                        @else
                            @foreach ($summaryFixedAssets as $key => $item)
                                <tr>
                                    <td class="text-center fw-semibold text-secondary align-middle" style="position: sticky; left: 0; z-index: 1;">{{ $key + 1 }}</td>
                                    <td class="text-start align-middle">text</td>
                                    <td class="text-start fw-medium align-middle">text</td>
                                    <td class="text-start align-middle">text</td>
                                    <td class="text-start fw-medium align-middle">text</td>
                                    <td class="text-start align-middle">text</td>
                                    <td class="text-start fw-medium align-middle">text</td>
                                    <td class="text-start align-middle">text</td>
                                    <td class="text-start fw-medium align-middle">text</td>
                                    <td class="text-start align-middle">text</td>
                                    <td class="text-start fw-medium align-middle">text</td>
                                    <td class="text-start align-middle">text</td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <style>
        .table-responsive table {
            white-space: nowrap;
        }
        .page-wrapper {
            width: 100%;
            overflow-x: hidden;
        }

        .page-content {
            width: 100%;
            overflow-x: hidden;
        }

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