<?php

namespace App\Models\Projects;

use Illuminate\Database\Eloquent\Model;

class ProjectImage extends Model
{
    protected $fillable = [
        'category_id',
        'image',
        'title',
        'sort_order',
        'is_active',
    ];

    public function category()
    {
        return $this->belongsTo(ProjectCategory::class , 'category_id');
    }
}