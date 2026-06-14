<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    protected $fillable = ['name', 'code'];

    public function attributes()
    {
        return $this->hasMany(ProductAttribute::class);
    }
}
