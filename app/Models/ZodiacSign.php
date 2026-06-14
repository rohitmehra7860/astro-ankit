<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class ZodiacSign extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'content',
        'image_url',
        'date_range',
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
