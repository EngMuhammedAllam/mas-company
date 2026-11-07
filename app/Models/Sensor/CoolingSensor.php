<?php

namespace App\Models\Sensor;

use Illuminate\Database\Eloquent\Model;

class CoolingSensor extends Model
{
    protected $fillable = ['name', 'location', 'sensor_key', 'max_threshold', 'min_threshold', 'is_active'];

    public function readings()
    {
        return $this->hasMany(TemperatureReading::class);
    }

    public function alerts()
    {
        return $this->hasMany(TemperatureAlert::class);
    }
}
