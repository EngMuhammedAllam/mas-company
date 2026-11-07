<?php

namespace App\Services;

use App\Repositories\Interfaces\ServiceRepositoryInterface;
use App\Repositories\Interfaces\ServiceSectionRepositoryInterface;
use App\Models\Service\Service;

class ServiceService
{
    protected $serviceRepo;
    protected $sectionRepo;

    public function __construct(
        ServiceRepositoryInterface $serviceRepo,
        ServiceSectionRepositoryInterface $sectionRepo
    ) {
        $this->serviceRepo = $serviceRepo;
        $this->sectionRepo = $sectionRepo;
    }

    public function getAllServices()
    {
        return $this->serviceRepo->get()->sortBy('sort_order');
    }

    public function getActiveServices()
    {
        return Service::active()->ordered()->get();
    }

    public function createService(array $data)
    {
        if (isset($data['image']) && is_object($data['image'])) {
            $data['image'] = $data['image']->store('services', 'public');
        }
        return $this->serviceRepo->create($data);
    }

    public function updateService(Service $service, array $data)
    {
        if (isset($data['image']) && is_object($data['image'])) {
            $data['image'] = $data['image']->store('services', 'public');
        }
        return $service->update($data);
    }

    public function deleteService(Service $service)
    {
        return $service->delete();
    }

    public function getSectionData()
    {
        return $this->sectionRepo->first();
    }

    public function updateSection(array $data)
    {
        $section = $this->sectionRepo->first();
        if (!$section) {
            return $this->sectionRepo->create($data);
        }
        return $section->update($data);
    }
}
