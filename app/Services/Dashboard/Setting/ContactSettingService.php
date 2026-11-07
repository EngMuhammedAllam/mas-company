<?php

namespace App\Services\Dashboard\Setting;

use App\Models\Setting\ContactSetting;

class ContactSettingService
{
    public function getContactSetting()
    {
        return ContactSetting::firstOrCreate([]);
    }

    public function updateContactSetting(array $data): bool
    {
        $setting = $this->getContactSetting();
        return $setting->update($data);
    }
}
