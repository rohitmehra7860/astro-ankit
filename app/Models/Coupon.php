<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = [
        'code',
        'type',
        'discount_value',
        'minimum_order_amount',
        'usage_limit',
        'used',
        'expires_at'
    ];

    public function isValid()
    {
        return ($this->expires_at == null || $this->expires_at >= now()) &&
            ($this->usage_limit == null || $this->used < $this->usage_limit);
    }
}
