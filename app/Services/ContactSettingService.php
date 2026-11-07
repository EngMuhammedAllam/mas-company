<?php

namespace App\Services;

use App\Repositories\Interfaces\ContactSettingRepositoryInterface;

class ContactSettingService
{
    protected $settingRepo;

    public function __construct(ContactSettingRepositoryInterface $settingRepo)
    {
        $this->settingRepo = $settingRepo;
    }

    public function getSettings()
    {
        return $this->settingRepo->first();
    }

    public function updateSettings(array $data)
    {
        $setting = $this->settingRepo->first();
        if (!$setting) {
            return $this->settingRepo->create($data);
        }
        return $setting->update($data);
    }
}
