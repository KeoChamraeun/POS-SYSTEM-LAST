<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = [
        'code',
        'name',
        'company_name',
        'phone',
        'email',
        'address',
        'note',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    /**
     * Generate next supplier code (CUST-0001, SUPP-0002, ...)
     */
    public static function generateCode(): string
    {
        $prefix = 'SUPP-';
        $last = self::latest('id')->first();

        if (!$last) {
            return $prefix . '0001';
        }

        $number = (int) substr($last->code, strlen($prefix));
        return $prefix . str_pad($number + 1, 4, '0', STR_PAD_LEFT);
    }
}