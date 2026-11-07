<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\Blog\BlogPost;
use App\Models\Blog\BlogCategory;
use Illuminate\Support\Facades\Cache;

class SitemapController extends Controller
{
    public function index()
    {
        // Cache sitemap for 24 hours
        $xml = Cache::remember('sitemap_xml', 86400, function () {
            return $this->generateSitemap();
        });

        return response($xml, 200)->header('Content-Type', 'application/xml');
    }

    private function generateSitemap()
    {
        $xml = '<?xml version="1.0" encoding="UTF-8"?>';
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        // Homepage
        $xml .= $this->addUrl(url('/'), now()->toIso8601String(), 'daily', '1.0');

        // Blog Posts
        $posts = BlogPost::active()->published()->orderBy('published_at', 'desc')->get();
        foreach ($posts as $post) {
            $xml .= $this->addUrl(
                route('blog.show', $post->id),
                $post->updated_at->toIso8601String(),
                'weekly',
                '0.8'
            );
        }

        // Blog Categories
        $categories = BlogCategory::active()->get();
        foreach ($categories as $category) {
            $xml .= $this->addUrl(
                route('blog.category', $category->id),
                $category->updated_at->toIso8601String(),
                'weekly',
                '0.6'
            );
        }

        $xml .= '</urlset>';

        return $xml;
    }

    private function addUrl($loc, $lastmod, $changefreq, $priority)
    {
        $xml = '<url>';
        $xml .= "<loc>{$loc}</loc>";
        $xml .= "<lastmod>{$lastmod}</lastmod>";
        $xml .= "<changefreq>{$changefreq}</changefreq>";
        $xml .= "<priority>{$priority}</priority>";
        $xml .= '</url>';

        return $xml;
    }
}
