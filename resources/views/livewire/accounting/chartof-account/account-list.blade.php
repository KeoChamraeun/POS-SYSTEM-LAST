<div class="container-fluid">
    <div class="row align-items-center g-3">
        <div class="col-md-6">
            <h3 class="mb-0 fw-bold text-dark">
                <i class="fas fa-users me-2 base-color"></i>
                {{ __('Chart Of Account List') }}
            </h3>
        </div>
        <div class="col-md-6 text-md-end">
            <button type="button" class="btn btn-primary" wire:click="open_new_modal">
                <span><i class="fas fa-plus me-2"></i></span>
                {{__('New Chart')}}
            </button>
        </div>
    </div>
    <div class="card shadow-sm border-0 mt-4">
        <div class="card-header pb-2">
            <div class="row align-items-center g-3">
                <div class="col-md-3">
                    <input type="search" class="form-control" wire:model.live="search"
                        placeholder="{{ __('Search...') }}">
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
                            <th class="text-center" style="position: sticky; left: 0;z-index: 1; width: 60px;">
                                {{ __('No.') }}
                            </th>
                            <th class="text-center">{{ __('Name') }}</th>
                            <th class="text-center">{{ __('Code') }}</th>
                            <th class="text-start">{{ __('Abbreviation') }}</th>
                            <th class="text-start">{{ __('Description') }}</th>
                            <th class="text-center">{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($chart_accounts as $i => $account)
                        <tr>
                            <td class="text-center">{{++$i}}</td>
                            <td class="text-center">{{$account->name}}</td>
                            <td class="text-center">{{$account->code}}</td>
                            <td class="text-start">{{$account->abbreviation}}</td>
                            <td class="text-start">{{$account->description}} description</td>
                            <td class="text-center align-middle">
                                <a wire:click="open_update_modal({{ $account->id }})"
                                    class="rounded-pill btn btn-sm btn-outline-success border-0 px-1 py-1">
                                    <i class="fa-solid fa-pen-to-square fa-lg"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @if ($chart_accounts->count())
                <div class="d-flex justify-content-start align-items-center mt-2">
                    <select class="form-select form-select-sm w-auto" wire:model.live="limit" aria-label="Default">
                        <option value="10">10</option>
                        <option value="30">30</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>
                @endif
                <div class="mt-3 pagination-orange">
                    {{ $chart_accounts->links() }}
                </div>
            </div>
        </div>
        @livewire('accounting.chartof-account.create-account')
        @livewire('accounting.chartof-account.update-account')
    </div>
</div>