<?php

namespace App\Http\Controllers\Dashboard\Projects;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Projects\ProjectSection;

class ProjectSectionController extends Controller
{
    public function edit()
    {
        $section = ProjectSection::firstOrCreate();
        return view('dashboard.projects.section-edit', compact('section'));
    }

    public function update(Request $request)
    {
        $section = ProjectSection::firstOrCreate();
        $section->update($request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
        ]));

        return redirect()->route('projects.index')->with('success', 'تم تحديث القسم العام بنجاح.');
    }
}