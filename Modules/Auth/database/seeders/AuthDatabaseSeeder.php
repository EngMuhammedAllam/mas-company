<?php

namespace Modules\Auth\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Modules\Auth\Models\User;

class AuthDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@compas.cooling',
            'password' => Hash::make('superadmin#1234'),
        ]);
        
        User::create([
            'name' => 'Admin',
            'email' => 'admin@compas.cooling',
            'password' => Hash::make('admin#1234'),
        ]);

        User::create([
            'name' => 'User',
            'email' => 'user@compas.cooling',
            'password' => Hash::make('user#1234'),
        ]);

        User::create([
            'name' => 'Muhammed Allam',
            'email' => 'muhammed.allam@compas.cooling',
            'password' => Hash::make('muhammed@1234'),
        ]);
    }
}
