<?php

namespace App\Services\Dashboard\About;

use App\Models\About\AboutPoint;
use App\Models\About\AboutSection;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class AboutSectionService
{
    public function getAboutSection()
    {
        return AboutSection::firstOrNew();
    }

    public function getAboutPoints($aboutSectionId)
    {
        if (!$aboutSectionId) return collect([]);
        return AboutPoint::where('about_section_id', $aboutSectionId)->get();
    }

    public function updateAboutSection(array $data, ?UploadedFile $image1 = null, ?UploadedFile $image2 = null, ?UploadedFile $image3 = null): AboutSection
    {
        $about = $this->getAboutSection();

        if ($image1) {
            if ($about->image1) Storage::disk('public')->delete($about->image1);
            $data['image1'] = $image1->store('about', 'public');
        }

        if ($image2) {
            if ($about->image2) Storage::disk('public')->delete($about->image2);
            $data['image2'] = $image2->store('about', 'public');
        }

        if ($image3) {
            if ($about->image3) Storage::disk('public')->delete($about->image3);
            $data['image3'] = $image3->store('about', 'public');
        }

        $about->fill($data)->save();

        return $about;
    }

    public function createPoint(array $data): ?AboutPoint
    {
        $about = AboutSection::first();
        if (!$about) return null;

        return AboutPoint::create([
            'about_section_id' => $about->id,
            'content' => $data['content']
        ]);
    }

    public function deletePoint($id): void
    {
        AboutPoint::findOrFail($id)->delete();
    }
}
