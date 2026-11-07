<?php

namespace App\Models\About;

use Illuminate\Database\Eloquent\Model;

class AboutPoint extends Model
{
    protected $table = 'about_points';
    protected $guarded = [];

    public function aboutSection()
    {
        return $this->belongsTo(AboutSection::class);
    }
}
