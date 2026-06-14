<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Gallery extends Model
{
    protected $fillable = [
        'title',
        'image_url',
        'order'
    ];

    protected static function booted()
    {
        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('order');
        });
    }
}
