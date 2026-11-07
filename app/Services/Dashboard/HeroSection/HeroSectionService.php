<?php

namespace App\Services\Dashboard\HeroSection;

use App\Models\Hero\HeroSection;
use App\Http\Traits\FileTrait;
use Illuminate\Http\UploadedFile;

class HeroSectionService
{
    use FileTrait;

    public function getHeroSection()
    {
        return HeroSection::first();
    }

    public function updateHeroSection(array $data, ?UploadedFile $image = null): bool
    {
        $heroSection = HeroSection::first();

        if ($image) {
            $this->deleteFile($heroSection->image, 'public');
            $data['image'] = $this->updateFile($image, $heroSection->image, 'hero');
        };

        return $heroSection->update($data);
    }
}
