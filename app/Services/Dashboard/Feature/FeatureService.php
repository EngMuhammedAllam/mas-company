<?php

namespace App\Services\Dashboard\Feature;

use App\Models\Feature\Feature;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class FeatureService
{
    public function getAllFeatures()
    {
        return Feature::all();
    }

    public function createFeature(array $data, ?UploadedFile $image = null): Feature
    {
        if ($image) {
            $data['image'] = $image->store('features', 'public');
        }
        return Feature::create($data);
    }

    public function getFeatureById($id)
    {
        return Feature::findOrFail($id);
    }

    public function updateFeature($id, array $data, ?UploadedFile $image = null): Feature
    {
        $feature = $this->getFeatureById($id);

        if ($image) {
            if ($feature->image && Storage::disk('public')->exists($feature->image)) {
                Storage::disk('public')->delete($feature->image);
            }
            $data['image'] = $image->store('features', 'public');
        }

        $feature->update($data);
        return $feature;
    }

    public function deleteFeature($id): void
    {
        $feature = $this->getFeatureById($id);
        if ($feature->image && Storage::disk('public')->exists($feature->image)) {
            Storage::disk('public')->delete($feature->image);
        }
        $feature->delete();
    }
}
