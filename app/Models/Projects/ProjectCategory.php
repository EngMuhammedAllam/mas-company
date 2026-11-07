<?php

namespace App\Models\Projects;

use Illuminate\Database\Eloquent\Model;

class ProjectCategory extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'is_active',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function images()
    {
        return $this->hasMany(ProjectImage::class, 'category_id')->where('is_active', true)->orderBy('sort_order');
    }
}
