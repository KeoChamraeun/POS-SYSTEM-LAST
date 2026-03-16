<div>  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/css/bootstrap-datepicker.min.css"/>
    <div style="min-height: 80vh; display: flex; flex-direction: column;">
        <h3><i class="fas fa-cog menu-icon" style="color: #5AC559"></i> <span>{{__('Setting')}}</span></h3> 
        <div class="row flex-grow-1 align-items-stretch"> 
            <div class="col-md-3 col-lg-3 d-flex">
                <div class="card w-100" style="max-height: 600px"> 
                    <aside class="settings-pro"> 
                        <div class="settings-pro-header">
                            <h5>{{ __('Settings') }}</h5>
                        </div>

                        <div class="settings-pro-section">
                            <p class="section-title">{{ __('Account') }}</p>

                            <button class="pro-item {{ $index == 0 ? 'active' : '' }}"
                                wire:click="$set('index', 0)">
                                <i class="fas fa-user"></i>
                                <span>{{ __('Profile') }}</span>
                            </button>
                        </div>

                        <div class="settings-pro-section">
                            <p class="section-title">{{ __('Preferences') }}</p>

                            <button class="pro-item {{ $index == 1 ? 'active' : '' }}"
                                wire:click="$set('index', 1)">
                                <i class="fas fa-palette"></i>
                                <span>{{ __('Appearance') }}</span>
                            </button>
                        </div>

                        <div class="settings-pro-section">
                            <p class="section-title">{{ __('System') }}</p>

                            <button class="pro-item {{ $index == 2 ? 'active' : '' }}"
                                wire:click="$set('index', 2)">
                                <i class="fas fa-history"></i>
                                <span>{{ __('System Log') }}</span>
                            </button>

                            {{-- @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                            <button class="pro-item {{ $index == 3 ? 'active' : '' }}"
                                wire:click="$set('index', 3)">
                                <i class="fas fa-cogs"></i>
                                <span>{{ __('System Config') }}</span>
                            </button>
                            @endif --}}
                        </div>

                    </aside>
                </div>
            </div> 
            <div class="col-md-9 col-lg-9 d-flex">
                @if($index==0)
                    <div class="card w-100 flex-fill" style="max-height: 600px; overflow-y: auto;">
                        <div class="col">
                            <div class="card-header pb-0">
                                <h4 class="card-title">{{ __('Profile') }}</h4> 
                                <hr style="border: 0; height: .5px; background-color: gray;"> 
                            </div> 
                            <form wire:submit.prevent="updateProfile">
                                <div class="card-body pt-0" wire:ignore>
                                    <div class="d-flex align-items-start gap-3"> 
                                        <div class="flex-shrink-0">
                                            <img id="user-avatar" src="{{ Auth::user()?->profile ? asset(Auth::user()->profile) : asset('assets/icon/profile.png') }}" alt="User Avatar" class="rounded-circle" style="width: 80px; height: 80px; object-fit: cover;">
                                        </div> 
                                        <div class="flex-grow-1">
                                            <h4 class="mb-1 fw-semibold text-truncate">{{ Auth::user()->name }}</h4>
                                            <p class="text-muted mb-3 font-13">{{ Auth::user()->role->name }}</p> 
                                            <div class="mb-2">
                                                <button type="button" id="change-image" class="btn btn-outline-secondary me-2">{{ __('Change image') }}</button>
                                                <button type="button" id="remove-image" class="btn btn-outline-danger">{{ __('Remove image') }}</button> 
                                                <input type="file" id="avatar-input" accept="image/png, image/jpeg, image/gif" style="display: none;" wire:model="profileImg">
                                            </div> 
                                            <p class="text-muted font-13 mb-0">{{ __('We support PNGs, JPEGs, and GIFs under 2MB.') }}</p>
                                        </div>
                                    </div>
                                    <div class="row g-3 align-items-end mt-2">
                                        <div class="col-md-4">
                                            <label class="form-label">{{ __('First Name') }} <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('first') is-invalid @enderror" placeholder="{{ __('Enter ') }}{{ __('First Name') }}" wire:model='first'>
                                            @error('first')
                                                <div class="invalid-feedback">
                                                    {{ __($message) }}
                                                </div>
                                            @enderror
                                        </div>  
                                        <div class="col-md-4">
                                            <label class="form-label">{{ __('Last Name') }} <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('last') is-invalid @enderror" placeholder="{{ __('Enter ') }}{{ __('Last Name') }}" wire:model='last'>
                                            @error('last')
                                                <div class="invalid-feedback">
                                                    {{ __($message) }}
                                                </div>
                                            @enderror
                                        </div>  
                                        <div class="col-md-4 d-flex justify-content-end">
                                            <button class="btn btn-outline-primary d-flex align-items-center" type="submit">
                                                <span class="me-2"><i class="fas fa-sync-alt"></i></span>
                                                {{ __('Update') }}
                                            </button>
                                        </div>
                                    </div> 
                                </div>
                            </form>

                            <div class="card-header pb-0"> 
                                <h4 class="card-title">{{ __('Account Security') }}</h4> 
                                <hr style="border: 0; height: .5px; background-color: gray;"> 
                            </div> 
                            <div class="card-body pt-0">
                                <form wire:submit.prevent="updateUsername">
                                    <div class="row align-items-end g-3">
                                        <div class="col-md-6">
                                            <label class="form-label">{{ __('Username') }} <span class="text-danger">*</span></label>
                                            <input type="text" 
                                                class="form-control @error('username') is-invalid @enderror" 
                                                wire:model="username" 
                                                placeholder="{{ __('Enter ') }}{{ __('Username') }}">
                                            @error('username')
                                                <div class="invalid-feedback">
                                                    {{ __($message) }}
                                                </div>
                                            @enderror
                                        </div>   
                                        <div class="col-md-6 d-flex justify-content-end">
                                            <button class="btn btn-outline-primary d-flex align-items-center" type="submit">
                                                <span class="me-2"><i class="fas fa-sync-alt"></i></span>
                                                {{__('Update')}}
                                            </button>
                                        </div>
                                    </div> 
                                </form>
                                <div class="row align-items-end g-3 mt-2">
                                    <div class="col-md-6">
                                        <label class="form-label">{{__('Password')}} <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" placeholder="{{__('Enter ')}}{{__('Password')}}" wire:model='password'readonly> 
                                    </div>  

                                    <div class="col-md-6 d-flex justify-content-end">
                                        <button class="btn btn-outline-danger d-flex align-items-center" wire:click='openChanePassword'>
                                            <span class="me-2"><i class="fas fa-lock-open"></i></span>
                                            {{__('Change password')}}
                                        </button>
                                    </div>
                                </div> 
                            </div>

                            <div class="card-header pb-0"> 
                                <h4 class="card-title">{{ __('Support Access') }}</h4> 
                                <hr style="border: 0; height: .5px; background-color: gray;"> 
                            </div> 
                            <div class="card-body pt-0">
                                <div class="row align-items-center g-3"> 
                                    <div class="col-md-6 d-flex flex-column justify-content-center">
                                        <h6 class="mb-1 fw-semibold text-truncate">{{ __('Log out of all devices') }}</h6>
                                        <p class="text-muted mb-0 small">{{ __('Log out of all other active session on other devices besides this one. ') }}</p>
                                    </div> 
                                    <div class="col-md-6 d-flex justify-content-md-end justify-content-start">
                                        <button class="btn btn-outline-danger d-flex align-items-center" wire:click='logout'>
                                            <i class="fas fa-right-from-bracket me-2"></i>
                                            {{ __('Log out') }}
                                        </button>

                                    </div>
                                </div>

                                <div class="row align-items-center g-3 mt-2"> 
                                    <div class="col-md-6 d-flex flex-column justify-content-center">
                                        <h6 class="mb-1 fw-semibold text-truncate text-danger">{{ __('Delete my account') }}</h6>
                                        <p class="text-muted mb-0 small">{{ __('Permanently delete the account and remove access from all workspace.') }}</p>
                                    </div> 
                                    <div class="col-md-6 d-flex justify-content-md-end justify-content-start">
                                        <button class="btn btn-outline-danger d-flex align-items-center" wire:click='delete'>
                                            <i class="fas fa-trash-alt me-2"></i>
                                            {{ __('Delete') }}
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                @elseif($index==1)
                    <div class="card w-100 flex-fill" style="max-height: 600px; overflow-y: auto;">
                        <div class="col">
                            <div class="card-header pb-0"> 
                                <h4 class="card-title">{{ __('Appearance') }}</h4> 
                                <hr style="border: 0; height: .5px; background-color: gray;"> 
                            </div> 
                            <div class="card-body pt-0"> 
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <img src="{{ asset('assets/svg/translate.svg') }}" alt="translate" width="36">
                                        </div>
                                        <div class="ms-3">
                                            <h6 class="mb-1 fw-semibold">{{ __('Language & Region') }}</h6>
                                            <p class="text-muted mb-0 font-12">
                                                {{ __('Set your language and regional preferences for date, time, and format display.') }}
                                            </p>
                                        </div>
                                    </div>

                                    <!-- Select on the right -->
                                    <div class="flex-shrink-0">
                                        <button type="button" class="btn btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                            @if(App::getLocale('locale') == 'en')
                                                {{__('English')}}
                                            @else
                                                {{__('Khmer')}}
                                            @endif
                                            <i class="las la-angle-down ms-1"></i></button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" wire:click="switchLanguage('kh')" wire:navigate.prevent style="cursor: pointer">
                                                <img src="{{asset('assets/images/flags/kh_flag.png')}}" alt="" height="15"  width="25px" class="me-2">
                                                {{__("Khmer")}}
                                            </a>
                                            <a class="dropdown-item" wire:click="switchLanguage('en')" wire:navigate.prevent style="cursor: pointer">
                                                <img src="{{asset('assets/images/flags/us_flag.png')}}" alt="" height="15" width="25px" class="me-2">
                                                {{__("English")}}
                                            </a>
                                        </div>
                                    </div>
                                </div>                            
                            </div>
                            <div class="card-header pb-0"> 
                                <h4 class="card-title">{{ __('Theme') }}</h4> 
                                <hr style="border: 0; height: .5px; background-color: gray;"> 
                            </div> 
                            <div class="card-body pt-0">
                                <div class="mb-3">
                                    <p class="text-muted mb-0 fs-13">
                                        {{ __('Choose your preferred appearance. You can switch themes anytime.') }}
                                    </p>
                                </div>  
                                <div class="row g-4 justify-content-center" x-data="{ theme: localStorage.getItem('theme') || 'light' }" x-init="$wire.set('theme', theme)"> 
                                    <div class="col-md-6" style="cursor:pointer">
                                        <div class="card h-100 theme-card" :class="theme === 'light' ? 'active-theme' : ''"
                                            @click="
                                                theme = 'light';
                                                localStorage.setItem('theme','light');
                                                $wire.toggleTheme('light');">
                                            <div class="card-body text-center">
                                                <h5 class="mb-2">{{ __('Light Theme') }}<i class="far fa-sun text-warning ms-1"></i></h5>
                                                <div class="theme-preview my-3"
                                                    style="background-image:url('{{ asset('assets/images/source/ligh.png') }}')">
                                                </div>
                                                <template x-if="theme === 'light'">
                                                    <span class="badge bg-primary">
                                                        <i class="fas fa-check-circle me-1"></i>{{ __('Active') }}
                                                    </span>
                                                </template>

                                                <template x-if="theme !== 'light'">
                                                    <span class="text-muted fs-14">
                                                        {{ __('Click to activate') }}
                                                    </span>
                                                </template>
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="col-md-6" style="cursor:pointer">
                                        <div class="card h-100 theme-card":class="theme === 'dark' ? 'active-theme' : ''"
                                            @click="
                                                theme = 'dark';
                                                localStorage.setItem('theme','dark');
                                                $wire.toggleTheme('dark');">
                                            <div class="card-body text-center">
                                                <h5 class="mb-2"> {{ __('Dark Theme') }} <i class="far fa-moon text-primary ms-1"></i></h5>
                                                <div class="theme-preview my-3"
                                                    style="background-image:url('{{ asset('assets/images/source/dark.png') }}')">
                                                </div>
                                                <template x-if="theme === 'dark'">
                                                    <span class="badge bg-primary">
                                                        <i class="fas fa-check-circle me-1"></i>{{ __('Active') }}
                                                    </span>
                                                </template>
                                                <template x-if="theme !== 'dark'">
                                                    <span class="text-muted fs-14">
                                                        {{ __('Click to activate') }}
                                                    </span>
                                                </template>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                        </div>  
                    </div>
                @elseif($index==2)
                    <div class="card shadow-sm rounded-3 w-100 flex-fill" style="max-height: 600px; overflow-y: auto;">
                        <div class="card-header py-2 d-flex align-items-center justify-content-between">
                            <h4 class="card-title mb-0">{{ __('System Log') }}</h4>
                            <small class="text-muted">{{__('Last updated:')}} {{ now()->format('d M Y H:i') }}</small>
                        </div>
                        <div class="card-body py-2"> 
                            <div class="row mb-3">
                                <div class="col-6 col-md-4">
                                    <label class="form-label fw-semibold mb-1">{{ __('Search') }}</label>
                                    <div class="input-group"> 
                                        <input type="search" class="form-control" wire:model.live="search" placeholder="{{__('Search...')}}">
                                    </div>
                                </div>
                                <div class="col-12 col-md-5">
                                    <label class="form-label fw-semibold mb-1">{{ __('Date Period') }}</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa-regular fa-calendar-days"></i></span>
                                        <input type="date" class="form-control" id="start_date" wire:model.live="start_date" placeholder="Start date">
                                        <span class="input-group-text">to</span>
                                        <input type="date" class="form-control" id="end_date" wire:model.live="end_date" placeholder="End date">
                                    </div>
                                </div>
                            </div> 
                            <div class="table-responsive">
                                <table class="table table-striped table-hover align-middle mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="text-center small"style="position: sticky; left: 0;z-index: 1; width: 60px;">
                                                {{ __('No.') }}
                                            </th>
                                            <th class="text-start small">{{ __('Action') }}</th>
                                            <th class="text-start small">{{ __('Description') }}</th>
                                            <th class="text-center small text-nowrap">
                                                <div class="d-inline-flex align-items-center">
                                                    {{ __('By User') }}
                                                    <div class="dropdown ms-4">
                                                        @if ($sort == 'desc' && $sortField == 'created_by_user')
                                                            <i class="fa-solid fa-arrow-up text-secondary"
                                                                style="font-size: 0.6rem; margin-right: 6px;"></i>
                                                        @elseif($sort == 'asc' && $sortField == 'created_by_user')
                                                            <i class="fa-solid fa-arrow-down text-secondary"
                                                                style="font-size: 0.6rem; margin-right: 6px;"></i>
                                                        @endif

                                                        <a href="#" class="text-secondary" data-bs-toggle="dropdown"
                                                            aria-expanded="false">
                                                            <i class="fa-solid fa-caret-down"></i>
                                                        </a>

                                                        <ul class="dropdown-menu">
                                                            <li>
                                                                <a class="dropdown-item d-flex justify-content-between align-items-center
                                                                    {{ $sortField == 'created_by_user' && $sort == 'asc' ? 'text-primary fw-semibold' : '' }}"
                                                                    href="#" wire:click="orderBy('created_by_user', 'asc')">
                                                                    <span>{{ __('Order by ') }}{{ __('By User') }}{{ __(' ASC') }}</span>
                                                                    <i class="fa-solid fa-arrow-up"
                                                                        style="font-size: 0.75rem; margin-left: 6px;"></i>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item d-flex justify-content-between align-items-center
                                                                    {{ $sortField == 'created_by_user' && $sort == 'desc' ? 'text-primary fw-semibold' : '' }}"
                                                                    href="#"
                                                                    wire:click="orderBy('created_by_user', 'desc')">
                                                                    <span>{{ __('Order by ') }}{{ __('By User') }}{{ __(' DESC') }}</span>
                                                                    <i class="fa-solid fa-arrow-down"
                                                                        style="font-size: 0.75rem; margin-left: 6px;"></i>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </th>
                                            <th class="text-center small text-nowrap">
                                                <div class="d-inline-flex align-items-center">
                                                    {{ __('Date Time') }}
                                                    <div class="dropdown ms-4">
                                                        @if ($sort == 'desc' && $sortField == 'created_at')
                                                            <i class="fa-solid fa-arrow-up text-secondary"
                                                                style="font-size: 0.6rem; margin-right: 6px;"></i>
                                                        @elseif($sort == 'asc' && $sortField == 'created_at')
                                                            <i class="fa-solid fa-arrow-down text-secondary"
                                                                style="font-size: 0.6rem; margin-right: 6px;"></i>
                                                        @endif

                                                        <a href="#" class="text-secondary" data-bs-toggle="dropdown"
                                                            aria-expanded="false">
                                                            <i class="fa-solid fa-caret-down"></i>
                                                        </a>

                                                        <ul class="dropdown-menu">
                                                            <li>
                                                                <a class="dropdown-item d-flex justify-content-between align-items-center
                                                                    {{ $sortField == 'created_at' && $sort == 'asc' ? 'text-primary fw-semibold' : '' }}"
                                                                    href="#" wire:click="orderBy('created_at', 'asc')">
                                                                    <span>{{ __('Order by ') }}{{ __('Date Time') }}{{ __(' ASC') }}</span>
                                                                    <i class="fa-solid fa-arrow-up" style="font-size: 0.75rem; margin-left: 6px;"></i>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item d-flex justify-content-between align-items-center
                                                                    {{ $sortField == 'created_at' && $sort == 'desc' ? 'text-primary fw-semibold' : '' }}"
                                                                    href="#"
                                                                    wire:click="orderBy('created_at', 'desc')">
                                                                    <span>{{ __('Order by ') }}{{ __('Date Time') }}{{ __(' DESC') }}</span>
                                                                    <i class="fa-solid fa-arrow-down" style="font-size: 0.75rem; margin-left: 6px;"></i>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (!count($systemLogs) > 0)
                                            <tr>
                                                <td colspan="5" class="text-center fw-semibold text-danger py-4">
                                                    <div class="d-flex flex-column align-items-center justify-content-center">
                                                        <lord-icon src="https://cdn.lordicon.com/wjyqkiew.json" trigger="loop"
                                                            delay="2000" colors="primary:#d97706,secondary:#eab308"
                                                            style="width:100px; height:100px">
                                                        </lord-icon>
                                                        <span class="mt-2">{{ __('No record found!') }}</span>
                                                    </div>
                                                </td>
                                            </tr>
                                        @else
                                            @foreach ($systemLogs as $key => $item)
                                                <tr>
                                                    <td class="text-center fw-semibold text-secondary small align-middle">{{ ++$key }}</td>
                                                    <td class="text-start small align-middle text-primary">{{ $item->action }}</td>
                                                <td class="text-start small fw-medium align-middle">
                                                    {{ $item->description }}
                                                    <span class="fw-bold text-primary">{{ $item->reference }}</span>
                                                </td>
                                                <td class="text-center small fw-semibold text-dark align-middle">{{ $item->created_by_user }}</td>
                                                <td class="text-center small align-middle">
                                                    @php $time = $item->updated_at; @endphp 
                                                    @if ($time->diffInHours(now()) < 1)
                                                        {{ $time->diffInMinutes(now()) }} {{__('m')}}
                                                        {{ $time->diffInSeconds(now()) % 60 }} {{__('s ago')}}

                                                    @elseif ($time->diffInHours(now()) < 24)
                                                        {{ $time->diffInHours(now()) }} {{__('h')}}
                                                        {{ $time->diffInMinutes(now()) % 60 }} {{__('m')}}
                                                        {{ $time->diffInSeconds(now()) % 60 }} {{__('s ago')}}

                                                    @else
                                                        {{ $time->diffInDays(now()) }}​ {{__('d ago')}}
                                                    @endif
                                                </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                                @if ($systemLogs->count())
                                    <div class="d-flex justify-content-start align-items-center mt-2">
                                        <select class="form-select form-select-sm w-auto" wire:model.live="limit" aria-label="Default">
                                            <option value="15">15</option>
                                            <option value="25">25</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                        </select>
                                    </div>
                                @endif
                                <div class="mt-3 pagination-orange">
                                    {{ $systemLogs->links() }}
                                </div>
                            </div>
                        </div>
                    </div>  
                @elseif($index==3)
                    <div class="card w-100 flex-fill" style="max-height: 600px; overflow-y: auto;">
                        <div class="col">
                            <div class="card-header pb-0"> 
                                <h4 class="card-title">{{ __('System Config') }}</h4> 
                                <hr style="border: 0; height: .5px; background-color: gray;"> 
                            </div> 
                            <div class="card-body pt-0"> 
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <img src="{{ asset('assets/svg/exchange.svg') }}" alt="translate" width="36">
                                        </div>
                                        <div class="ms-3">
                                            <h6 class="mb-1 fw-semibold">{{ __('Exchange Rate') }}</h6>
                                            <p class="text-muted mb-0 font-12">
                                                {{ __('Sets the conversion rate from USD to Cambodian Riel (KHR) for accurate calculations and display.') }}
                                            </p>
                                        </div>
                                    </div> 
                                    <div class="flex-shrink-0">
                                        <div class="input-group">
                                            <input type="number" class="form-control @error('khr') is-invalid @enderror" wire:model.live="khr" placeholder="{{ __('Enter ') . __('Exchange Rate') }} {{__('(Riel)')}}">
                                            <button type="button" wire:click="changeExchangeRate" wire:loading.attr="disabled"class="btn transition-all btn-outline-secondary">
                                                <span wire:loading>
                                                    <i class="fas fa-spinner fa-spin"></i>
                                                </span> 
                                                <span wire:loading.remove> 
                                                    <i class="far fa-file-alt"></i> 
                                                </span> 
                                            </button>
                                        </div>
                                        @error('khr')
                                            <div class="invalid-feedback d-block">{{ __($message) }}</div>
                                        @enderror 
                                        <small class="form-text text-muted">
                                            {{ __('$ 1.00 = ') }} {{get_money_khr($khr)}}
                                        </small>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="card-body pt-0">   
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover align-middle mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th class="text-center small"style="position: sticky; left: 0;z-index: 1; width: 60px;">
                                                    {{ __('No.') }}
                                                </th>
                                                <th class="text-center small">{{ __('Currency') }}</th>
                                                <th class="text-center small">{{ __('Rate') }}</th> 
                                                <th class="text-center small">{{ __('Date') }}</th> 
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (!count($exchangeRate) > 0)
                                                <tr>
                                                    <td colspan="4" class="text-center fw-semibold text-danger py-4">
                                                        <div class="d-flex flex-column align-items-center justify-content-center">
                                                            <lord-icon src="https://cdn.lordicon.com/wjyqkiew.json" trigger="loop"
                                                                delay="2000" colors="primary:#d97706,secondary:#eab308"
                                                                style="width:100px; height:100px">
                                                            </lord-icon>
                                                            <span class="mt-2">{{ __('No record found!') }}</span>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @else
                                                @foreach ($exchangeRate as $key => $value)
                                                    <tr>
                                                        <td class="text-center fw-semibold text-secondary small align-middle">{{ ++$key }}</td>
                                                        <td class="text-center small align-middle text-primary">{{ get_money($value->price) }}</td>
                                                        <td class="text-center small align-middle text-primary">{{ get_money_khr($value->rate) }}</td>
                                                        <td class="text-center small fw-semibold text-dark align-middle">{{ $value->created_at }}</td> 
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                    @if ($exchangeRate->count())
                                        <div class="d-flex justify-content-start align-items-center mt-2">
                                            <select class="form-select form-select-sm w-auto" wire:model.live="limit" aria-label="Default">
                                                <option value="15">15</option>
                                                <option value="25">25</option>
                                                <option value="50">50</option>
                                                <option value="100">100</option>
                                            </select>
                                        </div>
                                    @endif
                                    <div class="mt-3 pagination-orange">
                                        {{ $exchangeRate->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>  
                    </div>
                @endif
            </div> 
        </div>  
    </div>  
    @livewire('auth.change-password')  
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const avatarInput = document.getElementById('avatar-input');
            const userAvatar  = document.getElementById('user-avatar');
            const defaultAvatar = "{{ asset('assets/icon/profile.png') }}";

            // Change image
            document.getElementById('change-image').addEventListener('click', function () {
                avatarInput.click();
            });

            // Preview image
            avatarInput.addEventListener('change', function (event) {
                const file = event.target.files[0];
                if (!file) return;

                // Validate size (2MB)
                if (file.size > 2 * 1024 * 1024) {
                    Swal.fire({
                        icon: 'error',
                        title: 'មានបញ្ហា',
                        text: 'ទំហំរូបភាពលើសពី 2MB',
                    });

                    // Reset input & image
                    avatarInput.value = '';
                    userAvatar.src = defaultAvatar;
                    return;
                }

                const reader = new FileReader();
                reader.onload = function (e) {
                    userAvatar.src = e.target.result;
                };
                reader.readAsDataURL(file);
            });

            // Remove image
            document.getElementById('remove-image').addEventListener('click', function () {
                userAvatar.src = defaultAvatar;
                avatarInput.value = '';
            });

        });  
    </script>   
</div>