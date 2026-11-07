<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Services\Landing\BlogService;
use App\Services\Landing\LandingPageService;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    protected $landingService;
    protected $blogService;

    public function __construct(LandingPageService $landingService, BlogService $blogService)
    {
        $this->landingService = $landingService;
        $this->blogService = $blogService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('landing.index', $this->landingService->getLandingData());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function showSingleBlog($id)
    {
        return view('landing.blogs.single_blog', $this->blogService->getSingleBlogData($id));
    }

    public function showBlogCategory($id)
    {
        return view('landing.blogs.category', $this->blogService->getBlogCategoryData($id));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
