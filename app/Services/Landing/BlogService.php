<?php

namespace App\Services\Landing;

use App\Models\Blog\BlogCategory;
use App\Models\Blog\BlogPost;
use App\Models\Setting\SeoSetting;

class BlogService
{
    public function getSingleBlogData($id): array
    {
        $post = BlogPost::with('category')->active()->published()->findOrFail($id);

        // Increment views
        $post->increment('views');

        // Related posts
        $relatedPosts = BlogPost::where('blog_category_id', $post->blog_category_id)
            ->where('id', '!=', $post->id)
            ->active()
            ->published()
            ->take(3)
            ->get();

        // Categories
        $categories = cache()->remember('blog_categories', 1800, fn() => BlogCategory::active()->get());

        // SEO data
        $seo = cache()->remember('seo_settings', 3600, fn() => SeoSetting::first());

        return compact('post', 'relatedPosts', 'categories', 'seo');
    }

    public function getBlogCategoryData($id): array
    {
        $category = BlogCategory::findOrFail($id);
        $posts = BlogPost::where('blog_category_id', $id)
            ->active()
            ->published()
            ->orderBy('published_at', 'desc')
            ->paginate(10);

        $categories = cache()->remember('blog_categories', 1800, fn() => BlogCategory::active()->get());
        $seo = cache()->remember('seo_settings', 3600, fn() => SeoSetting::first());

        return compact('posts', 'category', 'categories', 'seo');
    }
}
