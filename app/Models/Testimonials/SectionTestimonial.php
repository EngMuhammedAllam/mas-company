<?php

namespace App\Models\Testimonials;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SectionTestimonial extends Model
{
    /** @use HasFactory<\Database\Factories\SectionTestimonialFactory> */
    use HasFactory;
    protected $fillable = [
        'title',
        'subtitle',
        'description',
    ];

    public function testimonials()
    {
        return $this->hasMany(Testimonial::class);
    }
}
