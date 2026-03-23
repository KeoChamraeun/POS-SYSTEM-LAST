<div class="container-fluid">  
    <div class="row align-items-center g-3"> 
        <div class="col-md-6">
            <h3 class="mb-0 fw-bold text-dark">
                <i class="fas fa-users me-2" style="color: #5AC559"></i>
                {{ __('User List') }}
            </h3> 
        </div> 
        <div class="col-md-6 text-md-end">
            <button type="button" class="btn btn-primary" wire:click="openUserModal">
                <span><i class="fas fa-plus me-2"></i></span>
                {{__('New User')}}
            </button>
        </div>
    </div> 

    <div class="card shadow-sm border-0 mt-4">
        <div class="card-header pb-2">
            <div class="row align-items-center g-3"> 
                <div class="col-md-3">
                    <label class="form-label text-muted mb-1">{{ __('Search') }}</label>
                    <input type="search" class="form-control" wire:model.live="search" placeholder="{{ __('Search...') }}">
                </div>
            </div>

            <div wire:loading wire:target="search, limit" 
                 class="fixed inset-0 bg-opacity-60 flex flex-col items-center justify-center z-50">
                <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;">
                    <span class="visually-hidden">{{ __('Loading...') }}</span>
                </div>
                <p class="mt-3 text-gray-700 text-sm font-medium">{{ __('Loading...') }}</p>
            </div>

            <div class="table-responsive mt-4" wire:loading.remove wire:target="search, limit">
                <table class="table table-striped table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="text-center" style="position: sticky; left: 0; z-index: 1; width: 60px;">
                                {{ __('No.') }}
                            </th>
                            <th class="text-start">{{ __('Full Name') }}</th>
                            <th class="text-start">{{ __('Username') }}</th> 
                            <th class="text-start">{{ __('Role') }}</th> 
                            <th class="text-start">{{ __('Phone') }}</th> 
                            <th class="text-start">{{ __('Date of Join') }}</th>  
                            <th class="text-start">{{__('Company')}}</th>
                            <th class="text-start">{{ __('Active') }} & {{ __('Banned') }}</th>  
                            <th class="text-center">{{ __('Action') }}</th> 
                        </tr>
                    </thead>
                    <tbody>
                        @if (!count($users) > 0)
                            <tr>
                                <td colspan="9" class="text-center fw-semibold text-danger py-4">
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
                            @foreach ($users as $index => $user)
                                <tr>
                                    <td class="text-center" style="position: sticky; left: 0; z-index: 1; width: 60px;">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td class="d-flex align-items-center">
                                        <img src="{{ $user->profile ? asset($user->profile) : asset('assets/icon/profile.png') }}" 
                                             class="thumb-md rounded-circle me-2" alt="Profile">
                                        {{ $user->name ?? '—' }}
                                    </td>
                                    <td class="text-start fw-semibold">{{ $user->username }}</td>
                                    <td class="text-start fw-semibold">
                                        {{ $user->role?->name ?? '—' }}
                                    </td>
                                    <td class="text-start">{{ $user->phone ?? '—' }}</td>
                                    <td class="text-start">
                                        {{ $user->created_at?->format('d M Y') ?? '—' }}
                                    </td> 
                                    {{-- <td class="text-start">
                                        <!-- Company column - adjust if needed -->
                                        {{ $user->company?->name ?? '—' }}
                                    </td> --}}
                                    <td class="text-start">
                                        <button type="button" class="btn btn-outline-{{ $user->active ? 'success' : 'danger' }} btn-sm px-3 py-1" 
                                                wire:click="updateActive({{ $user->id }})">
                                            {{ $user->active ? __('Active') : __('Inactive') }}
                                        </button>
                                    </td>
                                    <td class="text-start">
                                        <button type="button" class="btn btn-outline-{{ $user->banned ? 'danger' : 'success' }} btn-sm px-3 py-1" 
                                                wire:click="updateBanned({{ $user->id }})">
                                            {{ $user->banned ? __('Banned') : __('Not Banned') }}
                                        </button>
                                    </td>
                                    <td class="text-center align-middle">
                                        <a wire:click="restPasword({{ $user->id }})" class="rounded-pill btn btn-sm btn-outline-danger border-0 px-1 py-0 me-1">
                                            <i class="fas fa-unlock-alt fa-lg"></i>
                                        </a> 
                                        <a wire:click="updateUser({{ $user->id }})" class="rounded-pill btn btn-sm btn-outline-success border-0 px-1 py-0">
                                            <i class="fa-solid fa-pen-to-square fa-lg"></i>
                                        </a>
                                    </td> 
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>

                @if ($users->count())
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <div>
                            <select class="form-select form-select-sm w-auto" wire:model.live="limit">
                                <option value="10">10</option>
                                <option value="30">30</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                        <div class="pagination-orange">
                            {{ $users->links() }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    @livewire('users.user-create')
    @livewire('users.update-active')
    @livewire('users.update-banned')
    @livewire('users.user-update')
    @livewire('users.reset-password')

    <!-- Your existing script block -->
    <script> 
        const translations = <?php echo file_get_contents(resource_path('lang/kh.json')); ?>; 
        function __(key) {
            return translations[key] || key;  
        } 
        window.addEventListener('show-add-user-modal', event => {
            const modal = new bootstrap.Modal(document.getElementById('addUserModal'));
            modal.show();
        }); 
    </script>
</div>