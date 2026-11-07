<?php

namespace Database\Seeders;


use Carbon\Carbon;
use Illuminate\Database\Seeder;
use App\Models\Sensor\CoolingSensor;
use App\Models\Sensor\TemperatureAlert;
use App\Models\Sensor\TemperatureReading;

class SensorDataSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create Sensors
        $sensors = [
            [
                'name' => 'حساس المستودع الرئيسي',
                'location' => 'المستودع أ - المنطقة 1',
                'sensor_key' => 'SN-MAIN-001',
                'max_threshold' => 4.00,
                'min_threshold' => -18.00,
            ],
            [
                'name' => 'حساس وحدة التجميد',
                'location' => 'وحدة التجميد ب',
                'sensor_key' => 'SN-FREEZE-002',
                'max_threshold' => -15.00,
                'min_threshold' => -25.00,
            ],
            [
                'name' => 'حساس صالة العرض',
                'location' => 'صالة العرض الرئيسية',
                'sensor_key' => 'SN-SHOW-003',
                'max_threshold' => 24.00,
                'min_threshold' => 18.00,
            ],
        ];

        foreach ($sensors as $sensorData) {
            $sensor = CoolingSensor::create($sensorData);

            // 2. Generate historical readings for the last 24 hours
            $now = Carbon::now();
            for ($i = 24; $i >= 0; $i--) {
                $time = $now->copy()->subHours($i);

                // Normal reading with some randomness
                $baseTemp = ($sensor->max_threshold + $sensor->min_threshold) / 2;
                $temp = $baseTemp + rand(-200, 200) / 100;

                TemperatureReading::create([
                    'cooling_sensor_id' => $sensor->id,
                    'temperature' => $temp,
                    'created_at' => $time,
                ]);

                // Occasionally simulate an alert
                if ($i == 5 && $sensor->sensor_key == 'SN-MAIN-001') {
                    TemperatureAlert::create([
                        'cooling_sensor_id' => $sensor->id,
                        'temperature' => 6.50, // Above normal
                        'threshold_type' => 'high',
                        'threshold_value' => $sensor->max_threshold,
                        'severity' => 'critical',
                        'created_at' => $time,
                    ]);
                }
            }
        }
    }
}
