<?php

namespace App\Http\Controllers\Dashboard\Main;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Blog\BlogPost;
use App\Models\Blog\BlogCategory;
use App\Models\Projects\ProjectCategory;
use App\Models\Service\Service;
use App\Models\Testimonials\Testimonial;
use App\Models\Contact\Contact;
use App\Models\Client\Client;
use App\Models\Feature\Feature;
use App\Models\Counter\Counter;
use App\Models\Sensor\CoolingSensor;
use App\Models\Sensor\TemperatureAlert;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'blog_posts' => BlogPost::count(),
            'active_blog_posts' => BlogPost::active()->published()->count(),
            'blog_categories' => BlogCategory::count(),
            'project_categories' => ProjectCategory::count(),
            'services' => Service::count(),
            'testimonials' => Testimonial::count(),
            'contacts' => Contact::count(),
            'clients' => Client::count(),
            'features' => Feature::count(),
            'counters' => Counter::count(),
        ];

        $recent_contacts = Contact::latest()->take(5)->get();
        $recent_posts = BlogPost::latest()->take(5)->get();

        // Data for Charts
        // 1. Monthly Contacts (Last 6 months)
        $months = [];
        $contact_counts = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = now()->subMonths($i);
            $months[] = $month->format('M');
            $contact_counts[] = Contact::whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->count();
        }

        // 2. Content Distribution (Pie Chart)
        $distribution = [
            'labels' => ['المقالات', 'المشاريع', 'الخدمات'],
            'data' => [
                BlogPost::count(),
                ProjectCategory::count(),
                Service::count(),
            ]
        ];

        // 3. Growth Calculation
        $thisMonthContacts = Contact::whereYear('created_at', now()->year)->whereMonth('created_at', now()->month)->count();
        $lastMonthContacts = Contact::whereYear('created_at', now()->subMonth()->year)->whereMonth('created_at', now()->subMonth()->month)->count();
        $contactsGrowth = $lastMonthContacts > 0 ? (($thisMonthContacts - $lastMonthContacts) / $lastMonthContacts) * 100 : 100;

        $thisMonthPosts = BlogPost::whereYear('created_at', now()->year)->whereMonth('created_at', now()->month)->count();
        $lastMonthPosts = BlogPost::whereYear('created_at', now()->subMonth()->year)->whereMonth('created_at', now()->subMonth()->month)->count();
        $postsGrowth = $lastMonthPosts > 0 ? (($thisMonthPosts - $lastMonthPosts) / $lastMonthPosts) * 100 : 100;

        // 4. Blog Views (Last 6 months)
        $view_counts = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = now()->subMonths($i);
            $view_counts[] = BlogPost::whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->sum('views');
        }

        // 5. Sensor Monitoring
        // 5. Sensor Monitoring
        // Latest reading for cards
        $sensors = CoolingSensor::with(['readings' => function ($query) {
            $query->latest()->limit(1);
        }])->get();

        // Historical readings for chart
        $sensorHistory = CoolingSensor::with(['readings' => function ($query) {
            $query->latest()->limit(20);
        }])->get();

        $recent_alerts = TemperatureAlert::with('sensor')
            ->latest()
            ->limit(5)
            ->get();

        return view('dashboard.dashboard', compact(
            'stats',
            'recent_contacts',
            'recent_posts',
            'months',
            'contact_counts',
            'distribution',
            'contactsGrowth',
            'postsGrowth',
            'view_counts',
            'sensors',
            'sensorHistory',
            'recent_alerts'
        ));
    }
}
