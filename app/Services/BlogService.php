<?php

namespace App\Services;

use App\Repositories\Interfaces\BlogRepositoryInterface;
use App\Models\Blog\BlogCategory;
use App\Models\Blog\BlogPost;

class BlogService
{
    protected $blogRepo;

    public function __construct(BlogRepositoryInterface $blogRepo)
    {
        $this->blogRepo = $blogRepo;
    }

    public function getPostWithDetails(int $id)
    {
        $post = BlogPost::with('category')->findOrFail($id);
        $post->increment('views');

        $relatedPosts = BlogPost::where('blog_category_id', $post->blog_category_id)
            ->where('id', '!=', $post->id)
            ->active()
            ->published()
            ->take(3)
            ->get();

        $categories = BlogCategory::active()->get();

        return compact('post', 'relatedPosts', 'categories');
    }

    public function getCategoryPosts(int $categoryId)
    {
        $category = BlogCategory::findOrFail($categoryId);
        $posts = BlogPost::where('blog_category_id', $categoryId)
            ->active()
            ->published()
            ->orderBy('published_at', 'desc')
            ->paginate(10);

        $categories = BlogCategory::active()->get();

        return compact('posts', 'category', 'categories');
    }

    public function getAllPostsPaginated(int $perPage = 10)
    {
        return BlogPost::with('category')->latest()->paginate($perPage);
    }

    public function getActiveCategories()
    {
        return BlogCategory::active()->get();
    }

    public function createPost(array $data)
    {
        if (isset($data['image']) && is_object($data['image'])) {
            $data['image'] = $data['image']->store('blog', 'public');
        }
        return BlogPost::create($data);
    }

    public function updatePost(BlogPost $post, array $data)
    {
        if (isset($data['image']) && is_object($data['image'])) {
            $data['image'] = $data['image']->store('blog', 'public');
        }
        return $post->update($data);
    }

    public function deletePost(BlogPost $post)
    {
        return $post->delete();
    }
}
