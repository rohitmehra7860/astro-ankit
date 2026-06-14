<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class ProductImage extends Model
{
    protected $fillable = ['product_id', 'image_url', 'image_order'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    protected static function booted()
    {
        static::addGlobalScope('image_order', function (Builder $builder) {
            $builder->orderBy('image_order');
        });
    }
}
