<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class ProductCategory extends Model
{
    protected $fillable =
    [
        'parent_id',
        'title',
        'slug',
        'content',
        'image_url',
        'meta_tags',
        'order',
        'meta_title',
        'meta_description',
        'meta_keywords'
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo(ProductCategory::class, 'parent_id');
    }

    /**
     * Child Categories Relationship
     */
    public function children()
    {
        return $this->hasMany(ProductCategory::class, 'parent_id');
    }

    /**
     * Get categories with their children (Nested)
     */
    public function scopeWithChildren($query)
    {
        return $query->with('children');
    }

    protected static function booted()
    {
        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('order');
        });
    }
}
