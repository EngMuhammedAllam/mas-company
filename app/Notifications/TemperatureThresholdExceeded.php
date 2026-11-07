<?php

namespace App\Notifications;

use App\Models\Sensor\TemperatureAlert;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TemperatureThresholdExceeded extends Notification implements ShouldQueue
{
    use Queueable;

    protected $alert;

    public function __construct(TemperatureAlert $alert)
    {
        $this->alert = $alert;
    }

    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $sensor = $this->alert->sensor;
        return (new MailMessage)
            ->error()
            ->subject('🚨 تنبيه: تجاوز درجة الحرارة في ' . $sensor->location)
            ->greeting('تحذير طارئ!')
            ->line('تم رصد درجة حرارة غير طبيعية في ' . $sensor->name)
            ->line('الموقع: ' . $sensor->location)
            ->line('درجة الحرارة الحالية: ' . $this->alert->temperature . '°C')
            ->line('الحد المسموح به: ' . $this->alert->threshold_value . '°C (' . ($this->alert->threshold_type == 'high' ? 'أعلى حد' : 'أدنى حد') . ')')
            ->action('عرض التفاصيل في لوحة التحكم', url('/admin/dashboard'))
            ->line('يرجى التحقق من وحدة التبريد فوراً!');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'alert_id' => $this->alert->id,
            'sensor_name' => $this->alert->sensor->name,
            'temperature' => $this->alert->temperature,
            'location' => $this->alert->sensor->location,
            'message' => 'تجاوزت درجة الحرارة الحدود المسموحة في ' . $this->alert->sensor->location,
        ];
    }
}
