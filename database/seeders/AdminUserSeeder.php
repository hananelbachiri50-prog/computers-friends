<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create default admin user
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'admin',
                'password' => Hash::make('admin.26'),
                'role' => 'admin',
                'active' => true,
                'nom' => 'Admin',
                'prenom' => 'Computers Friends',
                'telephone' => '0600000000',
            ]
        );
    }
}
