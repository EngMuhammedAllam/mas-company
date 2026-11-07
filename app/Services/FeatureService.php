<?php

namespace App\Services;

use App\Repositories\Interfaces\FeatureRepositoryInterface;
use App\Models\Feature\Feature;

class FeatureService
{
    protected $featureRepo;

    public function __construct(FeatureRepositoryInterface $featureRepo)
    {
        $this->featureRepo = $featureRepo;
    }

    public function getAllFeatures()
    {
        return $this->featureRepo->all();
    }

    public function findFeature(int $id)
    {
        return $this->featureRepo->find($id);
    }

    public function createFeature(array $data)
    {
        if (isset($data['image']) && is_object($data['image'])) {
            $data['image'] = $data['image']->store('features', 'public');
        }
        return $this->featureRepo->create($data);
    }

    public function updateFeature(Feature $feature, array $data)
    {
        if (isset($data['image']) && is_object($data['image'])) {
            $data['image'] = $data['image']->store('features', 'public');
        }
        return $feature->update($data);
    }

    public function deleteFeature(Feature $feature)
    {
        return $feature->delete();
    }
}
