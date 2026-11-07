<?php

namespace App\Models\Feature;

use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    protected $table = 'features';

    protected $fillable = [
        'title',
        'description',
        'image',
    ];
}
