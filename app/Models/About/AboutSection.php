<?php

namespace App\Models\About;

use Illuminate\Database\Eloquent\Model;

class AboutSection extends Model
{
    protected $table = 'about_sections';
    protected $guarded = [];

    public function points()
    {
        return $this->hasMany(AboutPoint::class);
    }
}
