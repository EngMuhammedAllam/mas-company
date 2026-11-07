<?php

namespace App\Services;

use App\Repositories\Interfaces\AboutRepositoryInterface;
use App\Models\About\AboutSection;

class AboutService
{
    protected $aboutRepo;

    public function __construct(AboutRepositoryInterface $aboutRepo)
    {
        $this->aboutRepo = $aboutRepo;
    }

    public function getAboutData()
    {
        return $this->aboutRepo->getWithPoints();
    }

    public function updateAbout(array $data)
    {
        $section = $this->aboutRepo->first();
        if (isset($data['image']) && is_object($data['image'])) {
            $data['image'] = $data['image']->store('about', 'public');
        }

        if (!$section) {
            return $this->aboutRepo->create($data);
        }

        return $section->update($data);
    }

    public function syncPoints(AboutSection $section, array $points)
    {
        $section->points()->delete();
        foreach ($points as $point) {
            if (!empty($point)) {
                $section->points()->create(['content' => $point]);
            }
        }
    }

    public function addPoint(AboutSection $section, string $content)
    {
        return $section->points()->create(['content' => $content]);
    }

    public function deletePoint(int $id)
    {
        return \App\Models\About\AboutPoint::destroy($id);
    }
}
