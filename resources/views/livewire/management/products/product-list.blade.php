<div class="container-fluid">
    <div class="row align-items-center g-3 mb-4">
        <div class="col-md-6">
            <h3 class="mb-0 fw-bold text-dark">
                <i class="fas fa-box me-2" style="color: #5AC559;"></i>
                {{ __('Products List') }}
            </h3>
        </div>
        <div class="col-md-6 text-md-end">
            <button type="button" class="btn btn-primary" wire:click="openCreateProductModal">
                <i class="fas fa-plus me-2"></i> {{ __('Add Product') }}
            </button>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-header pb-2">
            <div class="row g-3">
                <div class="col-md-4 col-lg-3">
                    <label class="form-label text-muted mb-1">{{ __('Search') }}</label>
                    <input type="search" class="form-control" wire:model.live.debounce.400ms="search"
                           placeholder="{{ __('Search...') }}">
                </div>
            </div>
        </div>

        <div class="card-body p-0">
            <div wire:loading wire:target="search">
                <div class="position-absolute top-0 start-0 w-100 h-100 bg-white bg-opacity-75 d-flex flex-column align-items-center justify-content-center z-3">
                    <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status"></div>
                    <p class="mt-3 text-muted">{{ __('Loading...') }}</p>
                </div>
            </div>

            <div class="table-responsive" wire:loading.remove wire:target="search">
                <table class="table table-hover table-striped align-middle mb-0">
                    <thead class="table-light">
                    <tr>
                        <th class="text-center" style="width:60px;">#</th>
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Code') }}</th>
                        <th>{{ __('Barcode') }}</th>
                        <th>{{ __('Category') }}</th>
                        <th>{{ __('Brand') }}</th>
                        <th>{{ __('Unit') }}</th>
                        <th class="text-end">{{ __('Cost') }}</th>
                        <th class="text-end">{{ __('Sell') }}</th>
                        <th class="text-end">{{ __('Alert Qty') }}</th>
                        <th>{{ __('Status') }}</th>
                        <th class="text-center">{{ __('Actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($products as $index => $product)
                        <tr>
                            <td class="text-center">{{ $products->firstItem() + $index }}</td>
                            <td>{{ $product->name }}</td>
                            <td><code>{{ $product->code }}</code></td>
                            <td>{{ $product->barcode ?: '—' }}</td>
                            <td>{{ $product->category?->name ?? '—' }}</td>
                            <td>{{ $product->brand?->name ?? '—' }}</td>
                            <td>{{ $product->unit?->name ?? '—' }}</td>
                            <td class="text-end">{{ number_format($product->cost_price, 2) }}</td>
                            <td class="text-end">{{ number_format($product->selling_price, 2) }}</td>
                            <td class="text-end">{{ number_format($product->alert_qty, 2) }}</td>
                            <td>
                                @if($product->status)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-secondary">Inactive</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-outline-primary me-1"
                                        wire:click="editProduct({{ $product->id }})"
                                        title="{{ __('Edit Product') }}">
                                    <i class="fas fa-edit"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="12" class="text-center py-5 text-muted">
                                {{ __('No products found.') }}
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            <div class="card-footer d-flex justify-content-between align-items-center">
                <div>
                    {{ $products->links('vendor.pagination.bootstrap-5') }}
                </div>
                <small class="text-muted">
                    Showing {{ $products->count() }} of {{ $products->total() }}
                </small>
            </div>
        </div>
    </div>

    <livewire:management.products.create-product />
    <livewire:management.products.update-product />
</div>