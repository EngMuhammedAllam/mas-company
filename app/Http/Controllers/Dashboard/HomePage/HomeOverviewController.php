<?php

namespace App\Http\Controllers\Dashboard\HomePage;

use App\Http\Controllers\Controller;
use App\Models\HomePage\EquipmentCategory;
use App\Models\HomePage\EquipmentProduct;
use App\Models\HomePage\HomeSection;
use App\Models\HomePage\WhatsappInteraction;
use Illuminate\Support\Carbon;
use Illuminate\View\View;

class HomeOverviewController extends Controller
{
    public function __invoke(): View
    {
        return view('dashboard.mascool.overview', [
            'stats' => [
                'categories' => EquipmentCategory::where('is_active', true)->count(),
                'products' => EquipmentProduct::count(),
                'available' => EquipmentProduct::where('is_active', true)->where('is_available', true)->count(),
                'sections' => HomeSection::where('is_active', true)->count(),
                'sectionsTotal' => HomeSection::count(),
                'whatsapp30' => WhatsappInteraction::where('created_at', '>=', Carbon::now()->subDays(30))->count(),
            ],
            'recent' => EquipmentProduct::with('category:id,name')
                ->orderByDesc('updated_at')
                ->limit(6)
                ->get(),
            'byCategory' => EquipmentCategory::withCount([
                'products as products_count' => fn ($q) => $q->where('is_active', true),
            ])->orderByDesc('products_count')->get(),
        ]);
    }
}
