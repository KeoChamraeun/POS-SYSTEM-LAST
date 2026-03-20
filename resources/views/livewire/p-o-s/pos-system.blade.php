<div class="d-flex flex-column vh-100 bg-gray-50">

    <!-- Header – Modern & Slim -->
    <header class="bg-primary text-white px-4 py-3 shadow-lg d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center gap-3">
            <div class="bg-white text-dark rounded-circle p-2 d-flex align-items-center justify-content-center" style="width:42px; height:42px;">
                <i class="fas fa-cash-register fs-5"></i>
            </div>
            <h4 class="mb-0 fw-semibold">POS Terminal</h4>
        </div>

        <div class="d-flex align-items-center gap-4">
            <div class="d-flex align-items-center gap-2">
                <span class="text-white-75 small">Branch:</span>
                <strong class="fs-6">{{ $branches->find($branch_id)?->name ?? '—' }}</strong>
            </div>
            <div class="badge bg-white bg-opacity-25 px-3 py-2 fw-medium">
                {{ Auth::user()->name }}
            </div>
        </div>
    </header>

    <div class="flex-grow-1 overflow-hidden d-flex">

        <!-- Products Grid – Left Side -->
        <div class="col-lg-7 bg-white border-end d-flex flex-column shadow-sm">

            <!-- Search -->
            <div class="p-3 border-bottom bg-white sticky-top" style="z-index: 10;">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0 rounded-start" style="padding-left: 0.75rem;">
                        <i class="fas fa-search text-muted"></i>
                    </span>
                    <input type="text" class="form-control border-0 shadow-sm rounded-end py-2"
                        placeholder="{{ __('Search...') }}"
                        wire:model.live.debounce.300ms="search">
                </div>
            </div>
            <!-- Products -->
            <div class="flex-grow-1 overflow-auto p-4">
                <div class="row g-3">
                    @forelse($products as $product)
                        <div class="col-6 col-md-4 col-lg-3">
                            <div class="card h-100 border-0 shadow-sm hover-lift pos-item-card cursor-pointer rounded-xl"
                                 wire:click="addToCart({{ $product->id }})">
                                <div class="card-body text-center d-flex flex-column justify-content-center p-4">
                                    <div class="fw-semibold fs-5 mb-2 line-clamp-2">{{ $product->name }}</div>
                                    <div class="small text-muted mb-3 font-monospace">{{ $product->code }}</div>
                                    <div class="fs-4 fw-bold text-success">
                                        {{ number_format($product->selling_price, 0) }} <small class="fs-6">៛</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center py-5">
                            <div class="py-5">
                                <i class="fas fa-box-open fa-4x text-muted opacity-50 mb-4 d-block"></i>
                                <p class="text-muted fs-5">No products found</p>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Cart & Payment – Right Side -->
        <div class="col-lg-5 d-flex flex-column bg-white">

            <!-- Cart Items -->
            <div class="flex-grow-1 overflow-auto p-2 border-bottom">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="fw-semibold mb-0 d-flex align-items-center gap-2">
                        <i class="fas fa-shopping-cart text-primary"></i>
                        Cart
                        <span class="badge bg-primary rounded-pill px-2 py-1 ms-2">{{ count($cart) }}</span>
                    </h5>
                </div>

                @if(empty($cart))
                    <div class="text-center py-4">
                        <i class="fas fa-shopping-basket fa-4x text-muted opacity-25 mb-3 d-block"></i>
                        <p class="text-muted fs-5 fw-light">Your cart is empty</p>
                    </div>
                @else
                    @foreach($cart as $id => $item)
                        @php
                            $qty      = (float) ($item['qty'] ?? 1);
                            $price    = (float) ($item['price'] ?? 0);
                            $discount = (float) ($item['discount'] ?? 0);
                            $itemTotal = ($qty * $price) - $discount;
                        @endphp

                        <div class="card mb-2 border-0 shadow-sm rounded hover-lift-sm">
                            <div class="card-body p-2">
                                <div class="d-flex justify-content-between align-items-start mb-1">
                                    <div>
                                        <div class="fw-semibold">{{ $item['name'] }}</div>
                                        <div class="small text-muted font-monospace">{{ $item['code'] }}</div>
                                    </div>
                                    <div class="text-end">
                                        <div class="fw-bold text-success fs-6">
                                            {{ number_format($itemTotal, 0) }} ៛
                                        </div>
                                        <small class="text-muted">× {{ $qty }}</small>
                                    </div>
                                </div>

                                <div class="d-flex align-items-center gap-2 flex-wrap mt-1">
                                    <div class="btn-group btn-group-sm">
                                        <button class="btn btn-outline-secondary px-2" wire:click="decreaseQty({{ $id }})">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <button class="btn btn-outline-secondary disabled px-3 fw-bold">{{ $qty }}</button>
                                        <button class="btn btn-outline-secondary px-2" wire:click="increaseQty({{ $id }})">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>

                                    <input type="number" step="100" min="0"
                                        class="form-control form-control-sm text-end fw-medium shadow-none"
                                        style="width: 80px;" placeholder="Disc"
                                        wire:model.live.debounce.400ms="cart.{{ $id }}.discount">

                                    <button class="btn btn-sm btn-outline-danger ms-auto rounded-circle p-1"
                                            wire:click="removeFromCart({{ $id }})">
                                        <i class="fas fa-trash-can"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

            <!-- Totals & Actions – Sticky bottom feel -->
            <div class="p-4 bg-gradient-light border-top shadow-lg">

                <div class="row g-3 mb-4">
                    <div class="col-6">
                        <label class="form-label fw-medium small text-muted mb-1">Customer</label>
                        <select class="form-select form-select-lg shadow-sm" wire:model="customer_id">
                            <option value="">Walk-in Customer</option>
                            @foreach($customers as $c)
                                <option value="{{ $c->id }}">{{ $c->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-6">
                        <label class="form-label fw-medium small text-muted mb-1">Payment</label>
                        <select class="form-select form-select-lg shadow-sm" wire:model="payment_method">
                            <option value="cash">Cash</option>
                            <option value="card">Card</option>
                            <option value="aba">ABA</option>
                            <option value="acleda">ACLEDA</option>
                            <option value="wing">Wing</option>
                            <option value="bank">Bank Transfer</option>
                        </select>
                    </div>
                </div>

                <div class="row g-3 mb-4 bg-white bg-opacity-75 p-3 rounded-3 shadow-sm">
                    <div class="col-6">
                        <div class="small text-muted fw-medium">Total</div>
                        <div class="fs-3 fw-bold text-success text-end">
                            {{ number_format($this->total, 0) }} ៛
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="small text-muted fw-medium">Paid</div>
                        <input type="number" step="100" min="0"
                               class="form-control form-control-lg text-end fw-bold shadow-sm border-primary"
                               wire:model.live.debounce.300ms="paid_amount"
                               placeholder="0">
                    </div>
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-6">
                        <div class="small text-primary fw-medium">Change</div>
                        <div class="fs-4 fw-bold text-primary text-end">
                            {{ number_format($this->change, 0) }} ៛
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="small text-danger fw-medium">Due</div>
                        <div class="fs-4 fw-bold text-danger text-end">
                            {{ number_format($this->due, 0) }} ៛
                        </div>
                    </div>
                </div>

                <div class="d-grid gap-2 mb-3">
                    <button class="btn btn-success btn-lg fw-bold py-2 fs-7 rounded-pill shadow-lg"
                            wire:click="completeSale"
                            @if(empty($cart) || $this->paid_amount < $this->total) disabled @endif>
                        <i class="fas fa-check-circle me-2"></i> COMPLETE SALE
                    </button>
                </div>

                <textarea class="form-control shadow-sm rounded-3" rows="2" wire:model="note"
                          placeholder="Note / Special request / Delivery info..."></textarea>

            </div>
        </div>
    </div>

    <style>
        .bg-gradient-dark {
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
        }
        .bg-gradient-light {
            background: linear-gradient(to bottom, #f8fafc, #ffffff);
        }
        .hover-lift {
            transition: all 0.18s ease;
        }
        .hover-lift:hover {
            transform: translateY(-6px);
            box-shadow: 0 16px 40px rgba(0,0,0,0.12) !important;
        }
        .hover-lift-sm:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important;
        }
        .rounded-xl {
            border-radius: 1rem !important;
        }
        .rounded-pill-lg {
            border-radius: 999px !important;
        }
        .cursor-pointer { cursor: pointer; }
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        input:focus, select:focus {
            border-color: #3b82f6 !important;
            box-shadow: 0 0 0 0.25rem rgba(59,130,246,0.25) !important;
        }
    </style>

</div>

@script
<script>
    $wire.on('print-receipt', (event) => {
        const urlTemplate = '{{ route("pos-system.receipt.print", ["id" => "__ID__"]) }}';
        const url = urlTemplate.replace('__ID__', event.saleId);
        window.open(url, '_blank', 'width=420,height=680,scrollbars=yes');
    });
</script>
@endscript