<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SaleItem extends Model
{
    protected $fillable = [
        'sale_id',
        'product_id',
        'qty',
        'unit_price',
        'discount',
        'total',
    ];

    protected $casts = [
        'qty'        => 'decimal:2',
        'unit_price' => 'decimal:2',
        'discount'   => 'decimal:2',
        'total'      => 'decimal:2',
    ];

    public function sale(): BelongsTo
    {
        return $this->belongsTo(Sale::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function getEffectiveUnitPriceAttribute(): float
    {
        $qty = (float) $this->qty;
        $discount = (float) ($this->discount ?? 0);
        $unitPrice = (float) $this->unit_price;

        if ($qty <= 0) {
            return $unitPrice;
        }

        return $unitPrice - ($discount / $qty);
    }
}