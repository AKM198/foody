<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create default admin user
        Admin::create([
            'name' => 'Admin FOODY',
            'email' => 'admin@foody.com',
            'password' => Hash::make('password123'),
        ]);

        // You can add more admins here if needed
        // Admin::create([
        //     'name' => 'Second Admin',
        //     'email' => 'admin2@foody.com',
        //     'password' => Hash::make('password123'),
        // ]);
    }
}
