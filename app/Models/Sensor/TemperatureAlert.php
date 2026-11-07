<?php

namespace App\Models\Sensor;

use Illuminate\Database\Eloquent\Model;

class TemperatureAlert extends Model
{
    protected $fillable = ['cooling_sensor_id', 'temperature', 'threshold_type', 'threshold_value', 'severity', 'is_resolved', 'resolved_at'];

    public function sensor()
    {
        return $this->belongsTo(CoolingSensor::class, 'cooling_sensor_id');
    }
}
