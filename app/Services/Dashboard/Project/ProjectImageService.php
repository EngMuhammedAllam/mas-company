<?php

namespace App\Services\Dashboard\Project;

use App\Models\Projects\ProjectImage;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ProjectImageService
{
    public function createImage(array $data, UploadedFile $image): ProjectImage
    {
        $imagePath = $image->storeAs(
            'projects',
            time() . '_' . $image->getClientOriginalName(),
            'public'
        );

        return ProjectImage::create([
            'category_id' => $data['category_id'],
            'image' => basename($imagePath),
            'title' => $data['title'] ?? null,
            'sort_order' => $data['sort_order'] ?? 0,
            'is_active' => true,
        ]);
    }

    public function updateImage(ProjectImage $projectImage, array $data, ?UploadedFile $image = null): bool
    {
        $updateData = [
            'title' => $data['title'] ?? $projectImage->title,
            'sort_order' => $data['sort_order'] ?? $projectImage->sort_order,
        ];

        if ($image) {
            // Delete old image
            Storage::disk('public')->delete('projects/' . $projectImage->image);

            $imagePath = $image->storeAs(
                'projects',
                time() . '_' . $image->getClientOriginalName(),
                'public'
            );
            $updateData['image'] = basename($imagePath);
        }

        return $projectImage->update($updateData);
    }

    public function deleteImage(ProjectImage $projectImage): ?bool
    {
        Storage::disk('public')->delete('projects/' . $projectImage->image);
        return $projectImage->delete();
    }

    public function getImageById($id)
    {
        return ProjectImage::findOrFail($id);
    }
}
