<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Service extends Model
{

    protected $fillable = [
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

    protected static function booted()
    {
        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('order');
        });
    }
}
