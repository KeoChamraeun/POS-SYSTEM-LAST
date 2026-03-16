<div class="topbar d-print-none">
    <div class="container-xxl">
        <nav class="topbar-custom d-flex justify-content-between" id="topbar-custom">     
            <ul class="topbar-item list-unstyled d-inline-flex align-items-center mb-0">                        
                <li>
                    <button class="nav-link mobile-menu-btn nav-icon" id="togglemenu">
                        <i class="iconoir-menu-scale"></i>
                    </button>
                </li> 
                @php  
                    $hour = now()->hour; 
                    if ($hour < 12) {
                        $greeting = __('Good Morning');
                    } elseif ($hour < 18) {
                        $greeting = __('Good Afternoon');
                    } else {
                        $greeting = __('Good Evening');
                    } 
                    $dayName = now()->format('l'); // e.g., Monday
                    $day = now()->format('j');     // e.g., 13
                    $month = now()->format('F');   // e.g., January
                    $year = now()->format('Y');  
                    $monthKh = __(''.$month);  
                    $dayNameKh = __(''.$dayName); 
                    $currentDate = "$dayNameKh, $day $monthKh, $year";
                @endphp

                <li class="mx-3 welcome-text">
                    <h3 class="mb-0 fw-bold text-truncate" style="height: 32px">
                        {{ $greeting }}, {{ Auth::user()->name }}!
                    </h3>
                    <h6 class="mb-0 fw-normal text-muted text-truncate fs-14">
                        {{ $currentDate }}
                    </h6>                    
                </li>
            
            </ul>
            <ul class="topbar-item list-unstyled d-inline-flex align-items-center mb-0">     
                <li class="dropdown">
                    <a class="nav-link dropdown-toggle arrow-none nav-icon" data-bs-toggle="dropdown" href="#" role="button"
                    aria-haspopup="false" aria-expanded="false">
                    @if(App::getLocale('locale') == 'en')
                        <img src="{{asset('assets/images/flags/us_flag.png')}}" alt="" class="thumb-sm rounded-circle">
                    @else
                        <img src="{{asset('assets/images/flags/kh_flag.png')}}" alt="" class="thumb-sm rounded-circle">
                    @endif
                    </a>
                    <div class="dropdown-menu">
                        <livewire:Setting.Language />
                    </div>
                </li> 

                <li class="dropdown topbar-item">
                    <a class="nav-link dropdown-toggle arrow-none nav-icon" data-bs-toggle="dropdown" href="#" role="button"
                        aria-haspopup="false" aria-expanded="false">
                        <img src="{{ Auth::user()?->profile ? asset(Auth::user()->profile) : asset('assets/icon/profile.png') }}" alt="" class="thumb-lg rounded-circle">
                    </a>
                    <div class="dropdown-menu dropdown-menu-end py-0">
                        <div class="d-flex align-items-center dropdown-item py-2 bg-secondary-subtle">
                            <div class="flex-shrink-0">
                                <img src="{{ Auth::user()?->profile ? asset(Auth::user()->profile) : asset('assets/icon/profile.png') }}" alt="" class="thumb-md rounded-circle">
                            </div>
                            <div class="flex-grow-1 ms-2 text-truncate align-self-center">
                                <h6 class="my-0 fw-medium text-dark fs-13">
                                    {{ Auth::user()->name ?? '' }}
                                </h6>
                                <small class="text-muted mb-0">
                                    {{ Auth::user()->role->name ?? 'No Role' }}
                                </small> 
                            </div> 
                        </div>
                        <div class="dropdown-divider mt-0"></div>
                        <small class="text-muted px-2 pb-1 d-block">{{__('Account')}}</small>
                        <a class="dropdown-item" href="{{route('manage-setting')}}"><i class="las la-user fs-18 me-1 align-text-bottom"></i> {{__('Profile')}}</a> 
                        <small class="text-muted px-2 py-1 d-block">{{__('Settings')}}</small>                        
                        <a class="dropdown-item" href="{{route('manage-setting')}}"><i class="las la-cog fs-18 me-1 align-text-bottom"></i>{{__('Account Settings')}}</a>
                        <a class="dropdown-item" href="{{route('manage-setting')}}"><i class="las la-lock fs-18 me-1 align-text-bottom"></i> {{__('Security')}}</a>
                        <a class="dropdown-item" target="_blank" href="https://t.me/vearak91"><i class="las la-question-circle fs-18 me-1 align-text-bottom"></i> {{__('Help Center')}}</a>                       
                        <div class="dropdown-divider mb-0"></div>
                        <livewire:Auth.logout /> 
                    </div>
                </li>
            </ul><!--end topbar-nav-->
        </nav>
        <!-- end navbar-->
    </div>
</div>