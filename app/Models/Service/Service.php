<?php

namespace App\Models\Service;

use Illuminate\Database\Eloquent\Model;
use App\Models\Service\ServiceSection;

class Service extends Model
{
    protected $guarded = [];

    public function serviceSection()
    {
        return $this->belongsTo(ServiceSection::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'asc');
    }
}
