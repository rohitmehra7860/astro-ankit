<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'sku',
        'title',
        'slug',
        'content',
        'meta_tags',
        'order',
        'meta_title',
        'meta_description',
        'meta_keywords'
    ];

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }

    public function attributes()
    {
        return $this->hasMany(ProductAttribute::class, 'product_id');
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    protected static function booted()
    {
        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('order');
        });
    }
}
