<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockMovement extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch_id',
        'product_id',
        'type',
        'reference_id',
        'qty_in',
        'qty_out',
        'balance_after',
        'note',
        'created_by',
    ];

    protected $casts = [
        'qty_in'       => 'decimal:2',
        'qty_out'      => 'decimal:2',
        'balance_after' => 'decimal:2',
    ];

    public function branch() { return $this->belongsTo(Branch::class); }
    public function product() { return $this->belongsTo(Product::class); }
    public function user()   { return $this->belongsTo(User::class, 'created_by'); }
}
