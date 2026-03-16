<div>
    @if ($apply === 'role-apply-permission')
        @livewire('users.role.role-apply-permission', ['role_id' => $role_id])
    @else
        <div class="container-fluid">  
            <div class="row align-items-center g-3"> 
                <div class="col-md-6">
                    <h3 class="mb-0 fw-bold text-dark">
                        <i class="fa-solid fa-users-gear me-2 text-primary"></i>
                        {{ __('Role List') }}
                    </h3> 
                </div> 
                <div class="col-md-6 text-md-end">
                   <button type="button" class="btn btn-primary" wire:click="showRoleCreateModal">
                    <span><i class="fas fa-plus me-2"></i></span>
                    {{__('New Role')}}
                </button>
                </div>
            </div> 
            <div class="card shadow-sm border-0 mt-4">
                <div class="card-header pb-2">
                    <div class="row align-items-center g-3"> 
                        <div class="col-md-3">
                            <label class="form-label text-muted mb-1">
                                {{ __('Search') }}
                            </label>
                            <input type="search" class="form-control" wire:model.live="search" placeholder="{{ __('Search...') }}">
                        </div>
                    </div>
                    <div class="center-div">
                        <div wire:loading wire:target="search"
                            class="fixed inset-0 bg-opacity-60 flex flex-col items-center justify-center z-50">
                            <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;">
                                <span class="visually-hidden">{{ __('Loading...') }}</span>
                            </div>
                            <p class="mt-3 text-gray-700 text-sm font-medium">{{ __('Loading...') }}</p>
                        </div>
                    </div>
                    <div class="table-responsive mt-4" wire:loading.remove wire:target="search">
                        <table class="table table-striped table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-center"style="position: sticky; left: 0;z-index: 1; width: 60px;">
                                        {{ __('No.') }}
                                    </th>
                                    <th class="text-start">{{ __('Title') }}</th>
                                    <th class="text-start">{{ __('Description') }}</th> 
                                    <th class="text-center">{{ __('Status') }}</th> 
                                    <th class="text-center">{{ __('Action') }}</th> 
                                </tr>
                            </thead>
                            <tbody>
                                @if (!count($roles) > 0)
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
                                    @foreach ($roles as $key => $item)
                                        <tr>
                                            <td class="text-center fw-semibold text-secondary align-middle">{{ ++$key }}</td>
                                            <td class="text-start align-middle">{{$item->name}}</td>
                                            <td class="text-start fw-medium align-middle">{{ $item->description }}</td>
                                            <td class="text-center fw-semibold align-middle {{ $item->status ? 'text-primary' : 'text-danger' }}">
                                                {{ $item->status ? __('Active') : __('Inactive') }}
                                            </td> 
                                            <td class="text-center align-middle">
                                                <a wire:click="apply_role_permission({{ $item->id }})" class="rounded-pill btn btn-sm btn-outline-secondary border-0 px-1 py-0">
                                                    <i class="fas fa-shield-alt fa-lg"></i>
                                                </a> 
                                                <a wire:click="openEditRoleModal({{ $item->id }})" class="rounded-pill btn btn-sm btn-outline-success border-0 px-1 py-0">
                                                    <i class="fa-solid fa-pen-to-square fa-lg"></i>
                                                </a>
                                            </td> 
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table> 
                    </div>
                </div> 
            </div>

        </div>
        @livewire('users.role.role-create')
        @livewire('users.role.role-update')
    @endif 
</div>
