<?php

namespace App\Repositories\Eloquent;

use App\Models\Testimonials\SectionTestimonial;
use App\Repositories\Interfaces\SectionTestimonialRepositoryInterface;

class SectionTestimonialRepository extends BaseRepository implements SectionTestimonialRepositoryInterface
{
    public function __construct(SectionTestimonial $model)
    {
        parent::__construct($model);
    }

    public function getFirstActive()
    {
        return $this->model->where('is_active', 1)->first();
    }
}
