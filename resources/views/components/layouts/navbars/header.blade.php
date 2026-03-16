<?php

use App\Models\Department;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

// Get user role ID
if (Auth::user()->role_user) {
    $role_id = Auth::user()->role_user->role_id;
} else {
    $role_id = Auth::user()->staff->role_id;
}

// Get role permissions
$rolePermissions = \App\Models\RolePermission::where('role_id', $role_id)
    ->pluck('permission', 'department_id')
    ->toArray();

// Get Notification Department
$notificationDepartment = Department::where('slug', '/notification')->first();
$hasNotificationPermission = false;

if ($notificationDepartment && isset($rolePermissions[$notificationDepartment->id])) {
    $permissions = json_decode($rolePermissions[$notificationDepartment->id], true);
    if (!empty($permissions)) {
        $hasNotificationPermission = true;
    }
}
$notificationBranchIds = [];

if ($role_id == 7 && session()->has('branch_ids')) {
    $notificationBranchIds = session('branch_ids', []);
} elseif (session()->has('branch_id')) {
    $notificationBranchIds = [session('branch_id')];
}

$notifications = collect();
if (!empty($notificationBranchIds)) {
    $notifications = Notification::whereIn('branch_id', $notificationBranchIds)
        ->orderBy('id', 'desc')
        ->get();
}

$department = Department::where('slug', '/' . Request::segment(1))->first();
?>

<header id="header" class="header fixed-top d-flex align-items-center">
    <div class="d-flex align-items-center justify-content-between">
        <a href="{{ url('/') }}" class="logo d-flex align-items-center">
            {{-- <img src="{{ url('assets/svg/logo121.png') }}" class="img" alt="Phsar121"> --}}
            <span class="d-none d-lg-block"></span>
        </a>

        <i class="bi bi-list toggle-sidebar-btn"></i>

        <div class="branch-shop-info">
            {{-- Branch --}}
            @if (session()->has('branch') && auth()->check() && auth()->user()->staff?->role_id != 7)
            <div class="d-flex align-items-center">
                <span class="me-2">
                    {{ session('branch')->operational_area?->local_code ?? '' }}
                    ({{ session('branch')->loan_company?->name ?? '' }})
                </span>
            </div>
            @endif

            {{-- Shop --}}
            @if (session()->has('shop'))
            <div class="d-flex align-items-center">
                <span class="me-2">
                    {{ session('shop')->name }}
                    ({{ session('shop')->operational_area?->local_code ?? '' }})
                </span>
            </div>
            @endif
        </div>


        {{-- 3. MULTIPLE BRANCHES (role_id = 7) --}}
        @if (auth()->check() && auth()->user()->staff?->role_id == 7 && session()->has('branch_ids'))
        @php
        $branchIds = session('branch_ids', []);
        $branchCount = count($branchIds);
        $branches = \App\Models\Branch::with(['operational_area', 'loan_company'])
        ->whereIn('id', $branchIds)
        ->get();
        @endphp

        <div class="dropdown">
            <a href="#" class="d-flex align-items-center text-decoration-none" data-bs-toggle="dropdown">
                <span class="me-2">
                    <strong>{{ $branchCount }} {{ Str::plural('branch', $branchCount) }}</strong>
                    @if($branchCount > 0)
                    <small class="text-muted">
                        ({{ $branches->first()->operational_area->local_code ?? '' }})
                    </small>
                    @endif
                </span>
                <i class="bi bi-chevron-down"></i>
            </a>

            <ul class="dropdown-menu dropdown-menu-end shadow">
                @foreach($branches as $branch)
                <li>
                    <a href="#" class="dropdown-item d-flex justify-content-between align-items-center"
                        onclick="event.preventDefault(); switchBranch({{ $branch->id }})">
                        <span>
                            {{ $branch->operational_area?->local_code ?? '—' }}
                            ({{ $branch->loan_company?->name ?? '—' }})
                        </span>
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>

    <!-- End Logo -->
    <nav class="header-nav ms-auto nav-my">
        <ul class="d-flex align-items-center">

            <!-- Session Branch/Shop -->
            <ul class="d-flex align-items-center" style="flex-wrap: nowrap;">


                <!-- Language Switcher -->
                <li class="nav-item" style="{{ !$hasNotificationPermission ? 'margin-right: 16px;' : '' }}">
                    <livewire:Component.SwitchLanguage />
                </li>
            </ul>

            <!-- Notification Section -->
            @if ($hasNotificationPermission)
            <li class="nav-item dropdown hover-dropdown">
                <a class="nav-link nav-icon nav-item d-flex {{ !$notifications->where('is_read', false)->count() ? 'no-notifications' : '' }}"
                    href="#"
                    data-bs-toggle="dropdown"
                    role="button"
                    aria-expanded="false">
                    <img src="{{ asset('assets/svg/notification.svg') }}" alt="notification!" style="height: 26px;">
                    @if ($notifications->where('is_read', false)->count() > 0)
                    <span class="badge bg-primary badge-number">
                        {{ $notifications->where('is_read', false)->count() }}
                    </span>
                    @endif
                </a>

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notification-dropdown animate__animated animate__fadeIn p-0"
                    style="width: 360px; max-height: 420px; overflow-y: auto;">

                    @forelse ($notifications as $item)
                    <li class="notification-item {{ $item->is_read ? '' : 'unread-notification' }} border-bottom">
                        <a href="{{ route('notification', $item->notification_ref) }}"
                            wire:navigate
                            class="d-flex gap-3 p-3 text-decoration-none text-dark hover-bg-light">

                            {{-- Avatar --}}
                            <div class="flex-shrink-0">
                                @if ($item->agency && $item->agency->agency_profile)
                                <img src="{{ staff_profile($item->agency->agency_profile) }}"
                                    width="48" height="48"
                                    class="rounded-circle shadow-sm"
                                    alt="Profile">
                                @else
                                <div class="rounded-circle bg-light d-flex justify-content-center align-items-center shadow-sm"
                                    style="width: 48px; height: 48px;">
                                    <i class="fas fa-user text-secondary"></i>
                                </div>
                                @endif
                            </div>

                            {{-- Content --}}
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between">
                                    <span class="fw-semibold text-primary">
                                        {{ label_translation($item->application?->customer ?? '') }}
                                    </span>

                                    <small class="text-muted">
                                        {{ $item->created_at?->diffForHumans(['parts' => 2, 'short' => true]) }}
                                    </small>
                                </div>

                                <div class="mt-1 small text-muted">
                                    @if ($item->type == 'assinged')
                                    {{ __('assigned application to') }}
                                    @else
                                    {{ __('requested application by') }}
                                    @endif

                                    <span class="fw-semibold text-dark">
                                        {{ $item->user?->username ?? '' }}
                                    </span>
                                </div>
                            </div>
                        </a>
                    </li>
                    @empty
                    <li class="text-center py-4 text-muted small">
                        {{ __('No notifications available') }}
                    </li>
                    @endforelse
                </ul>

            </li>
            @endif
            <!-- End Notification Nav -->

            <!-- Profile Dropdown -->
            <li class="nav-item dropdown pe-3 hover-dropdown" style="margin-left: -16px">
                <a class="nav-link nav-profile d-flex align-items-center pe-0 nav-item d-flex" href="#">
                    <img src="{{ staff_profile(Auth::user()->profile) }}"
                        style="border: 0.2px solid #E2B134; transition: transform 0.3s ease; object-fit: cover; width: 32px; height: 32px; border-radius: 50%;"
                        alt="{{ Auth::user()->name }}" class="profile-img">
                </a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow settings-dropdown"
                    style="width: 250px; opacity: 0; transform: translateY(-10px); transition: all 0.3s ease-in-out; background: #fff; box-shadow: 0 4px 12px rgba(0,0,0,0.15); border-radius: 8px;">
                    <li class="dropdown-header" style="padding: 15px;">
                        <h6 style="margin: 0; font-weight: 600; color: #E2B134">{{ Auth::user()->name }}</h6>
                        <span style="color: #666; font-size: 0.9rem; font-size: 12px">
                            {{ __(Auth::user()->staff->role->name) }}
                        </span>
                    </li>
                    <li>
                        <hr class="dropdown-divider" style="margin: 5px 0;">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center"
                            href="{{ route('user-profile', Auth::id()) }}"
                            style="padding: 10px 15px; transition: background 0.2s ease, transform 0.2s ease;">
                            <img src="{{ asset('assets/svg/profile.svg') }}"
                                style="width: 24px; height: 24px; margin-right: 8px; filter: invert(77%) sepia(49%) saturate(7492%) hue-rotate(1deg) brightness(97%) contrast(107%);">
                            <span>{{ __('My Profile') }}</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider" style="margin: 5px 0;">
                    </li>
                    <li>
                        <livewire:Auth.logout />
                    </li>
                    <li>
                        <hr class="dropdown-divider" style="margin: 5px 0;">
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
</header>
<style>
    .hover-dropdown {
        position: relative;
    }

    .hover-dropdown .dropdown-menu {
        display: none;
        padding: 12px;
        position: absolute;
        top: 100%;
        right: 0;
        z-index: 1000;
        margin-top: 0;
        opacity: 0;
        transition: opacity 0.3s ease-in, transform 0.3s ease-in;
        pointer-events: none;
    }

    .hover-dropdown:hover .dropdown-menu {
        display: block;
        opacity: 1;
        pointer-events: auto;
        transform: translateY(0) !important;
        visibility: visible !important;
    }

    .no-notification-gap {
        margin-right: 16px;
    }

    .no-notifications {
        color: #6c757d;
        cursor: default;
    }

    .nav-my {
        display: flex;
        align-items: center;
    }

    .profile-img:hover {
        transform: scale(1.1);
    }

    .dropdown-item:hover {
        background: #f8f9fa;
        /*transform: translateX(5px);*/
    }

    .notification-dropdown {
        width: 320px;
        max-height: 400px;
        overflow-y: auto;
        border: none;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        background: #fff;
        padding: 0;
    }

    .notification-item {
        border-bottom: 1px solid #e9ecef;
        transition: transform 0.2s ease, background-color 0.2s ease;
    }

    .notification-item:last-child {
        border-bottom: none;
    }

    .notification-item:hover {
        transform: scale(1.02);
        background-color: #f8f9fa;
    }

    .unread-notification {
        background-color: #e6f3ff;
    }

    .notification-link {
        padding: 12px 15px;
        text-decoration: none;
        color: #212529;
        position: relative;
        display: flex;
        gap: 10px;
    }

    .notification-avatar {
        flex-shrink: 0;
    }

    .notification-avatar img,
    .notification-avatar i {
        width: 40px;
        height: 40px;
        object-fit: cover;
        color: #6c757d;
    }

    .notification-content {
        flex-grow: 1;
        overflow: hidden;
    }

    .notification-content h6 {
        font-size: 0.9rem;
        line-height: 1.3;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .notification-content p {
        font-size: 0.8rem;
        margin: 0;
    }

    .unread-badge {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        color: #007bff;
        font-size: 0.7rem;
    }

    .unread-badge:hover {
        color: #0056b3;
    }

    @media (max-width: 767px) {
        .branch-info {
            display: none;
        }

        .notification-dropdown {
            width: 280px;
            max-height: 300px;
            right: 10px !important;
        }

        .notification-link {
            padding: 10px 12px;
            gap: 8px;
        }

        .notification-avatar img,
        .notification-avatar i {
            width: 32px;
            height: 32px;
        }

        .notification-content h6 {
            font-size: 0.85rem;
        }

        .notification-content p {
            font-size: 0.75rem;
        }

        .unread-badge {
            right: 12px;
            font-size: 0.6rem;
        }

        .nav-my {
            flex-wrap: wrap;
            gap: 10px;
        }

        .nav-item {
            margin: 5px 0;
        }

        .dropdown-menu {
            width: 100%;
            max-width: 280px;
            right: 0 !important;
        }

        .profile-img {
            width: 28px !important;
            height: 28px !important;
        }
    }

    @media (max-width: 767px) {
        .branch-shop-info {
            display: none;
        }
    }
</style>

@push('scripts')
<script>
    document.addEventListener('livewire:initialized', () => {
        // Notification dropdown animations
        const notificationDropdown = document.querySelector('.notification-dropdown');
        if (notificationDropdown) {
            notificationDropdown.addEventListener('show.bs.dropdown', () => {
                notificationDropdown.classList.add('animate__fadeIn');
                notificationDropdown.classList.remove('animate__fadeOut');
            });
            notificationDropdown.addEventListener('hide.bs.dropdown', () => {
                notificationDropdown.classList.add('animate__fadeOut');
                notificationDropdown.classList.remove('animate__fadeIn');
            });
        }

        // Sidebar toggle
        const toggleButton = document.querySelector('.toggle-sidebar-btn');
        const body = document.querySelector('body');
        if (toggleButton) {
            toggleButton.addEventListener('click', () => {
                body.classList.toggle('toggle-sidebar');
            });
        }
    });
</script>
@endpush