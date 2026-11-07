<?php

namespace App\Models\Service;

use Illuminate\Database\Eloquent\Model;

class ServiceSection extends Model
{
    protected $table = 'service_sections';
    protected $guarded = [];


    public function scopeActive($query)
    {
        return $query->where('is_active', true)->first();
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }
}
