<div class="container-fluid"> 
    <div class="d-flex align-items-center mb-4">
        <h3 class="mb-0 fw-bold text-dark">
            <i class="fa-solid fa-gauge me-2 text-primary"></i>
            {{ __('Dashboard') }}
        </h3> 
    </div> 
    <div class="card shadow-sm border-0">
        <div class="card-header pb-2">
            <div class="row align-items-center g-3"> 
                <div class="col-md-6">
                    <h5 class="card-title mb-0 fw-semibold">
                        {{ __('Monthly Summary:') }}  {{ __(\Carbon\Carbon::parse($month)->format('F')) }} {{\Carbon\Carbon::parse($month)->format('Y')}}
                    </h5>
                </div> 
                <div class="col-md-6 text-md-end">
                    <div class="d-inline-block text-start">
                        <label class="form-label text-muted mb-1">
                            {{ __('Select Month') }}
                        </label>
                        <input type="month" class="form-control" wire:model.live="month">
                    </div>
                </div>
            </div> 
            <hr class="mt-3 mb-0">
        </div> 
        <div class="card-body">
            <div class="row"> 
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card border shadow-sm rounded-4 h-100 hover-scale">
                        <div class="card-body d-flex align-items-center"> 
                            <div class="flex-shrink-0 me-3">
                                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width:60px; height:60px;">
                                    <i class="fa-solid fa-user fa-lg"></i>
                                </div>
                            </div> 
                            <div class="flex-grow-1">
                                <h6 class="text-muted mb-1">{{ __('Total Staffs') }}</h6> 
                                <h3 class="fw-bold mb-0">{{ $staffCount }}</h3> 
                                <small class="{{ $staffPercent >= 0 ? 'text-success' : 'text-danger' }}">
                                    {{ $staffPercent >= 0 ? '+' : '' }}{{ $staffPercent }}%
                                    {{ __('from last month') }}
                                </small>
                            </div> 
                        </div>
                    </div>
                </div> 
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card border shadow-sm rounded-4 h-100 hover-scale">
                        <div class="card-body d-flex align-items-center">
                            <div class="flex-shrink-0 me-3">
                                <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center" style="width:60px; height:60px;">
                                    <i class="fa-solid fa-dollar-sign fa-lg"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="text-muted mb-1">{{__('Total Staffs')}}</h6>
                                <h3 class="fw-bold mb-0">$9 240,560</h3>
                                <small class="text-success">+8% {{__('from last month')}}</small>
                            </div>
                        </div>
                    </div>
                </div> 
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card border shadow-sm rounded-4 h-100 hover-scale">
                        <div class="card-body d-flex align-items-center">
                            <div class="flex-shrink-0 me-3">
                                <div class="bg-warning text-white rounded-circle d-flex align-items-center justify-content-center" style="width:60px; height:60px;">
                                    <i class="fa-solid fa-chart-line fa-lg"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="text-muted mb-1">Performance</h6>
                                <h3 class="fw-bold mb-0">89%</h3>
                                <small class="text-danger">-3% {{__('from last month')}}</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    </div>
    <style> 
        .hover-scale {
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .hover-scale:hover {
            transform: translateY(-5px);
            box-shadow: 0 0.75rem 1.5rem rgba(0,0,0,0.2);
        }
    </style>
</div> 