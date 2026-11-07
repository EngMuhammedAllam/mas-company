<?php

namespace App\Services\Dashboard\Service;

use App\Models\Service\ServiceSection;

class ServiceSectionService
{
    public function getServiceSection()
    {
        return ServiceSection::first();
    }

    public function getServices(ServiceSection $section = null)
    {
        $section = $section ?? $this->getServiceSection();
        return $section ? $section->services()->latest()->get() : collect();
    }

    public function updateServiceSection(ServiceSection $section, array $data): bool
    {
        return $section->update([
            'title' => $data['title'],
            'description' => $data['description'],
        ]);
    }

    public function getServiceSectionById($id)
    {
        return ServiceSection::findOrFail($id);
    }
}
