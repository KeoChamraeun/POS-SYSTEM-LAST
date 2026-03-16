<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    protected $fillable = [
        'category_id', 'brand_id', 'unit_id',
        'code', 'barcode', 'name', 'slug',
        'description', 'image',
        'cost_price', 'selling_price', 'alert_qty',
        'has_expiry', 'status',
    ];

    protected $casts = [
        'cost_price'    => 'decimal:2',
        'selling_price' => 'decimal:2',
        'alert_qty'     => 'decimal:2',
        'has_expiry'    => 'boolean',
        'status'        => 'boolean',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class);
    }
}