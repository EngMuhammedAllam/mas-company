<?php

namespace App\Services\Dashboard\Project;

use App\Models\Projects\ProjectCategory;
use App\Models\Projects\ProjectSection;

class ProjectService
{
    public function getProjectDashboardData(): array
    {
        $section = ProjectSection::where('is_active', true)->first();
        // Fallback or handle null if needed, but original code just did first().
        // Actually original code was: ProjectSection::where('is_active', true)->first();
        // Wait, ProjectSectionController uses firstOrCreate(), but ProjectController uses where('is_active', true)->first().
        // This implies there might be an is_active column on project_sections table.
        // Let's stick to exactly what ProjectController did.

        $categories = ProjectCategory::with('images')->get();

        return compact('section', 'categories');
    }
}
