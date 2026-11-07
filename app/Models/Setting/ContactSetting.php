<?php

namespace App\Models\Setting;

use Illuminate\Database\Eloquent\Model;

class ContactSetting extends Model
{
    protected $fillable = [
        'title',
        'description',
        'email',
        'phone',
        'address',
        'map_url',
        'facebook',
        'twitter',
        'instagram',
        'linkedin',
    ];
}
