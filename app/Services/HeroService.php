<?php

namespace App\Services;

use App\Repositories\Interfaces\HeroRepositoryInterface;
use App\Models\Hero\HeroSection;

class HeroService
{
    protected $heroRepo;

    public function __construct(HeroRepositoryInterface $heroRepo)
    {
        $this->heroRepo = $heroRepo;
    }

    public function getHeroData()
    {
        return $this->heroRepo->first();
    }

    public function updateHero(array $data)
    {
        $hero = $this->heroRepo->first();
        if (isset($data['image']) && is_object($data['image'])) {
            $data['image'] = $data['image']->store('hero', 'public');
        }

        if (!$hero) {
            return $this->heroRepo->create($data);
        }
        return $hero->update($data);
    }
}
