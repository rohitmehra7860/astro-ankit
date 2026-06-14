<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'site_name',
        'light_logo',
        'dark_logo',
        'favicon',
        'contact_emails',
        'contact_phones',
        'whatsapp_number',
        'map_iframe',
        'address',
        'footer_text',
        'social_links',
        'header_code',
        'footer_code'
    ];

    protected $casts = [
        'contact_emails' => 'array',
        'contact_phones' => 'array',
        'social_links' => 'array',
        'address' => 'array'
    ];
}
