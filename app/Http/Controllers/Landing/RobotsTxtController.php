<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;

class RobotsTxtController extends Controller
{
    public function index()
    {
        $content = $this->generateRobotsTxt();

        return response($content, 200)->header('Content-Type', 'text/plain');
    }

    private function generateRobotsTxt()
    {
        $txt = "User-agent: *\n";
        $txt .= "Allow: /\n";
        $txt .= "\n";

        // Disallow admin and private areas
        $txt .= "Disallow: /admin/\n";
        $txt .= "Disallow: /dashboard/\n";
        $txt .= "Disallow: /login\n";
        $txt .= "Disallow: /register\n";
        $txt .= "Disallow: /password/\n";
        $txt .= "\n";

        // Sitemap, location
        $txt .= "Sitemap: " . url('/sitemap.xml') . "\n";

        return $txt;
    }
}
