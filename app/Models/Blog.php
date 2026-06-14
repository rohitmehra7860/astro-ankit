<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'content',
        'meta_tags',
        'image_url',
        'meta_title',
        'meta_description',
        'meta_keywords'
    ];
}
