<?php

namespace App\Services\Dashboard\Cta;

use App\Models\Cta\CtaSection;

class CtaSectionService
{
    public function getCtaSection()
    {
        return CtaSection::firstOrNew();
    }

    public function updateCtaSection(array $data): CtaSection
    {
        $cta = $this->getCtaSection();
        $cta->fill($data)->save();
        return $cta;
    }
}
