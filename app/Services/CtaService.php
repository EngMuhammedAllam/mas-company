<?php

namespace App\Services;

use App\Repositories\Interfaces\CtaRepositoryInterface;

class CtaService
{
    protected $ctaRepo;

    public function __construct(CtaRepositoryInterface $ctaRepo)
    {
        $this->ctaRepo = $ctaRepo;
    }

    public function getCtaData()
    {
        return $this->ctaRepo->first();
    }

    public function updateCta(array $data)
    {
        $section = $this->ctaRepo->first();
        if (isset($data['image']) && is_object($data['image'])) {
            $data['image'] = $data['image']->store('cta', 'public');
        }

        if (!$section) {
            return $this->ctaRepo->create($data);
        }
        return $section->update($data);
    }
}
