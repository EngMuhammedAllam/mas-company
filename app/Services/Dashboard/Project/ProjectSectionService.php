<?php

namespace App\Services\Dashboard\Project;

use App\Models\Projects\ProjectSection;

class ProjectSectionService
{
    public function getProjectSection()
    {
        return ProjectSection::firstOrCreate();
    }

    public function updateProjectSection(ProjectSection $section, array $data): bool
    {
        return $section->update([
            'title' => $data['title'],
            'description' => $data['description'],
        ]);
    }
}
