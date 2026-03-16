@php
    use App\Models\Department;
    use Illuminate\Support\Facades\Auth;

    $role_id = Auth::user()->role_user->role_id ?? Auth::user()->role_id;
    $getDepartment = Department::whereNull('parent_id')
        ->where('slug', '!=', '/')
        ->whereHas('children.role_permission', function ($q) use ($role_id) {
            $q->where('role_id', $role_id);
        })
        ->orderBy('sort', 'asc')
        ->get();
    $permis_access_dash = Department::where('slug', '/')
        ->whereHas('role_permission', function ($q) use ($role_id) {
            $q->where('role_id', $role_id);
        })
        ->exists();
@endphp

<aside class="startbar d-print-none">
    <div class="brand">
        <a wire:navigate href="{{ route('dashboard') }}" class="logo">
            <span>
                <img src="{{ asset('assets/images/logo-sm.png') }}" alt="logo-small" class="logo-sm">
            </span>
            <span>
                <img src="{{ asset('assets/images/logo.png') }}" alt="logo-large" class="logo-lg logo-light" height="50">
            </span>
        </a>
    </div>

    <div class="startbar-menu">
        <div class="startbar-collapse" id="startbarCollapse" data-simplebar>
            <div class="d-flex align-items-start flex-column w-100">
                <ul class="navbar-nav mb-auto w-100">

                    <li class="menu-label pt-0 mt-0">
                        <span>{{ __('Main Menu') }}</span>
                    </li> 
                    @if($permis_access_dash)
                        <li class="nav-item">
                            <a wire:navigate
                               href="{{ route('dashboard') }}"
                               class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                                <i class="iconoir-home-simple menu-icon"></i>
                                <span>{{ __('Dashboard') }}</span>
                            </a>
                        </li>
                    @endif 
                    @foreach($getDepartment as $depart)
                        @php
                            $children = $depart->children()
                                ->whereHas('role_permission', fn ($q) => $q->where('role_id', $role_id))
                                ->orderBy('sort', 'asc')
                                ->get();

                            $isAnyChildActive = $children->contains(fn ($child) =>
                                request()->is(trim($child->slug, '/') . '/*') ||
                                request()->is(trim($child->slug, '/'))
                            );
                        @endphp

                        <li class="nav-item">
                            <a class="nav-link {{ $isAnyChildActive ? '' : 'collapsed' }}"
                               href="#sidebarDept{{ $depart->id }}"
                               data-bs-toggle="collapse"
                               role="button"
                               aria-expanded="{{ $isAnyChildActive ? 'true' : 'false' }}"
                               aria-controls="sidebarDept{{ $depart->id }}">

                                {!! $depart->icon !!}
                                <span>{{ get_translation($depart) }}</span>
                                <i class="bi bi-chevron-down ms-auto"></i>
                            </a>

                            <div class="collapse {{ $isAnyChildActive ? 'show' : '' }}"
                                 id="sidebarDept{{ $depart->id }}">
                                <ul class="nav flex-column">
                                    @foreach($children as $child)
                                        <li class="nav-item">
                                            <a 
                                               href="{{ url($child->slug) }}"
                                               class="nav-link {{ request()->is(trim($child->slug, '/') . '/*') || request()->is(trim($child->slug, '/')) ? 'active' : '' }}">
                                                <i class="bi bi-circle"></i>
                                                <span>{{ get_translation($child) }}</span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </li>
                    @endforeach
                    @if($permis_access_dash)
                        <li class="nav-item">
                            <a wire:navigate
                               href="{{ route('manage-setting') }}"
                               class="nav-link {{ request()->routeIs('manage-setting') ? 'active' : '' }}">
                                <i class="fas fa-cog menu-icon"></i></i>
                                <span>{{ __('Setting') }}</span>
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</aside>
