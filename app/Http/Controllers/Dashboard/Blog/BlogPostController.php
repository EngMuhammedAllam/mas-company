<?php

namespace App\Http\Controllers\Dashboard\Blog;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Blog\StoreBlogPostRequest;
use App\Http\Requests\Dashboard\Blog\UpdateBlogPostRequest;
use App\Models\Blog\BlogPost;
use App\Models\Blog\BlogCategory;
use App\Services\Dashboard\Blog\BlogPostService;
use Illuminate\Http\Request;

class BlogPostController extends Controller
{
    protected $blogPostService;

    public function __construct(BlogPostService $blogPostService)
    {
        $this->blogPostService = $blogPostService;
    }

    public function index()
    {
        $posts = $this->blogPostService->getAllPosts();
        return view('dashboard.blog.posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = BlogCategory::active()->get();
        return view('dashboard.blog.posts.create', compact('categories'));
    }

    public function store(StoreBlogPostRequest $request)
    {
        $this->blogPostService->createPost(
            $request->validated(),
            $request->file('image')
        );

        return redirect()->route('admin.posts.index')->with('success', 'تم إضافة المقال بنجاح');
    }

    public function edit(Request $request)
    {
        $post = BlogPost::findOrFail($request->id);
        $categories = BlogCategory::active()->get();
        return view('dashboard.blog.posts.edit', compact('post', 'categories'));
    }

    public function update(UpdateBlogPostRequest $request)
    {
        $post = BlogPost::findOrFail($request->id);

        $this->blogPostService->updatePost(
            $post,
            $request->validated(),
            $request->file('image')
        );

        return redirect()->route('admin.posts.index')->with('success', 'تم تعديل المقال بنجاح');
    }

    public function destroy(Request $request)
    {
        $post = BlogPost::findOrFail($request->id);
        $this->blogPostService->deletePost($post);
        return redirect()->route('admin.posts.index')->with('success', 'تم حذف المقال');
    }
}
