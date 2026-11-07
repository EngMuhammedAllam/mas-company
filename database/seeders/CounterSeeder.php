<?php

namespace Database\Seeders;

use App\Models\Counter\Counter;
use Illuminate\Database\Seeder;

class CounterSeeder extends Seeder
{
    public function run(): void
    {
        Counter::create([
            'title' => 'عدد العملاء',
            'number' => 100,
        ]);
        Counter::create([
            'title' => 'عميل راضي',
            'number' => 100,
        ]);
        Counter::create([
            'title' => 'عدد المشاريع',
            'number' => 100,
        ]);
        Counter::create([
            'title' => 'عدد العملاء',
            'number' => 30
        ]);
        Counter::create([
            'title' => "سنة خبرة",
            'number' => 5,
        ]);
    }
}
