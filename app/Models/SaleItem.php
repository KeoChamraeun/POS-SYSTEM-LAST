<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SaleItem extends Model
{
    protected $fillable = [
        'sale_id',
        'product_id',
        'quantity',
        'unit_price',
        'discount_amount',
        'line_total',
        'tax_amount',
        'batch_number',
        'expiry_date',
    ];

    protected $casts = [
        'quantity'      => 'decimal:3',
        'unit_price'    => 'decimal:2',
        'discount_amount' => 'decimal:2',
        'line_total'    => 'decimal:2',
        'tax_amount'    => 'decimal:2',
        'expiry_date'   => 'date',
    ];

    public function sale(): BelongsTo
    {
        return $this->belongsTo(Sale::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    // Optional helper: effective price after discount
    public function getEffectiveUnitPriceAttribute(): float
    {
        return $this->unit_price - ($this->discount_amount / $this->quantity);
    }
}