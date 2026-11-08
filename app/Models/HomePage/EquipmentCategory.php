<?php

namespace App\Models\HomePage;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EquipmentCategory extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'short_description',
        'image',
        'image_alt',
        'media_shape',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function products(): HasMany
    {
        return $this->hasMany(EquipmentProduct::class);
    }

    /** Active products in display order — used for eager loading. */
    public function activeProducts(): HasMany
    {
        return $this->products()->where('is_active', true)->orderBy('sort_order')->orderBy('id');
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order')->orderBy('id');
    }

    public function getRouteKeyName(): string
    {
        return 'id';
    }
}
