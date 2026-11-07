<?php

namespace App\Services\Dashboard\Setting;

use App\Models\Setting\SeoSetting;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class SeoSettingService
{
    public function getSeoSetting()
    {
        return SeoSetting::firstOrCreate([]);
    }

    public function updateSeoSetting(array $data, ?UploadedFile $ogImage = null, ?UploadedFile $favicon = null): bool
    {
        $seo = $this->getSeoSetting();

        if ($ogImage) {
            if ($seo->og_image) {
                Storage::disk('public')->delete($seo->og_image);
            }
            $data['og_image'] = $ogImage->store('seo', 'public');
        }

        if ($favicon) {
            if ($seo->favicon) {
                Storage::disk('public')->delete($seo->favicon);
            }
            $data['favicon'] = $favicon->store('seo', 'public');
        }

        return $seo->update($data);
    }
}
