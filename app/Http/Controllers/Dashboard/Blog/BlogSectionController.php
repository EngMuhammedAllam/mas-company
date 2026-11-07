<?php

namespace App\Http\Controllers\Dashboard\Blog;

use App\Http\Controllers\Controller;
use App\Models\Blog\BlogSection;
use Illuminate\Http\Request;

class BlogSectionController extends Controller
{
    public function edit()
    {
        $blogSection = BlogSection::firstOrCreate([]);
        return view('dashboard.blog.section.edit', compact('blogSection'));
    }

    public function update(Request $request)
    {
        $blogSection = BlogSection::firstOrCreate([]);

        $data = $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        $blogSection->update($data);

        return redirect()->back()->with('success', 'Blog section updated successfully.');
    }
}
