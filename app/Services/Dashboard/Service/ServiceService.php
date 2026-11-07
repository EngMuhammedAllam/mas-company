<?php

namespace App\Services\Dashboard\Service;

use App\Models\Service\Service;
use App\Models\Service\ServiceSection;
use App\Http\Traits\FileTrait;
use Illuminate\Http\UploadedFile;

class ServiceService
{
    use FileTrait;

    public function createService(array $data, ?UploadedFile $icon = null): Service
    {
        if ($icon) {
            $data['icon'] = $this->uploadFile($icon, 'services', 'public');
        }

        return Service::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'icon' => $data['icon'] ?? null,
            'is_active' => isset($data['is_active']) && $data['is_active'] === 'on',
            'sort_order' => $data['sort_order'] ?? 0,
            'service_section_id' => ServiceSection::first()->id,
        ]);
    }

    public function updateService(Service $service, array $data, ?UploadedFile $icon = null): bool
    {
        if ($icon) {
            if ($service->icon) {
                $this->deleteFile($service->icon);
            }
            $data['icon'] = $this->uploadFile($icon, 'services', 'public');
        }

        return $service->update([
            'title' => $data['title'],
            'description' => $data['description'],
            'icon' => $data['icon'] ?? $service->icon,
            'is_active' => isset($data['is_active']) && $data['is_active'] === 'on',
            'sort_order' => $data['sort_order'] ?? $service->sort_order,
        ]);
    }

    public function deleteService(Service $service): ?bool
    {
        if ($service->icon) {
            $this->deleteFile($service->icon);
        }

        return $service->delete();
    }

    public function getServiceById($id)
    {
        return Service::findOrFail($id);
    }
}
