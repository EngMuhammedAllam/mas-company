<?php

namespace App\Models\Testimonials;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $table = 'testimonials';
    protected $guarded = [];

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }
}
