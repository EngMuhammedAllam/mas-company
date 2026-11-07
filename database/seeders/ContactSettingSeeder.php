<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting\ContactSetting;

class ContactSettingSeeder extends Seeder
{
    public function run(): void
    {
        ContactSetting::create([
            'email' => 'info@sensors.test',
            'phone' => '+20 123 456 7890',
            'address' => 'القاهرة، مصر',
            'facebook' => '#',
            'twitter' => '#',
            'linkedin' => '#',
            'instagram' => '#',
        ]);
    }
}
