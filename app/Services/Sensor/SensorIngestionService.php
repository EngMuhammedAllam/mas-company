<?php

namespace App\Services\Sensor;

use App\Models\Sensor\CoolingSensor;
use App\Models\Sensor\TemperatureReading;
use App\Models\Sensor\TemperatureAlert;
use App\Models\Auth\User;
use App\Notifications\TemperatureThresholdExceeded;
use Illuminate\Support\Facades\Notification;

class SensorIngestionService
{
    /**
     * Process the sensor ingestion.
     *
     * @param string $sensorKey
     * @param float $temperature
     * @return array
     */
    public function ingest(string $sensorKey, float $temperature): array
    {
        $sensor = CoolingSensor::where('sensor_key', $sensorKey)->firstOrFail();

        // 1. Record the reading
        $reading = TemperatureReading::create([
            'cooling_sensor_id' => $sensor->id,
            'temperature' => $temperature,
            'created_at' => now(),
        ]);

        // 2. Check thresholds
        $alertData = $this->checkThresholds($sensor, $temperature);
        $alertTriggered = $alertData['triggered'];

        if ($alertTriggered) {
            $alert = TemperatureAlert::create([
                'cooling_sensor_id' => $sensor->id,
                'temperature' => $temperature,
                'threshold_type' => $alertData['type'],
                'threshold_value' => $alertData['value'],
                'severity' => 'critical',
            ]);

            // Notify admins
            $admins = User::where('is_admin', true)->get();
            Notification::send($admins, new TemperatureThresholdExceeded($alert));
        }

        return [
            'status' => 'success',
            'alert_triggered' => $alertTriggered,
            'reading' => $reading
        ];
    }

    /**
     * Check if temperature exceeds thresholds.
     *
     * @param CoolingSensor $sensor
     * @param float $temperature
     * @return array
     */
    private function checkThresholds(CoolingSensor $sensor, float $temperature): array
    {
        if ($temperature >= $sensor->max_threshold) {
            return [
                'triggered' => true,
                'type' => 'high',
                'value' => $sensor->max_threshold
            ];
        } elseif ($temperature <= $sensor->min_threshold) {
            return [
                'triggered' => true,
                'type' => 'low',
                'value' => $sensor->min_threshold
            ];
        }

        return [
            'triggered' => false,
            'type' => null,
            'value' => null
        ];
    }
}
