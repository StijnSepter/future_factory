<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; // Import your User model
use Illuminate\Support\Facades\Hash; // Import Hash facade

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Admin User
        User::firstOrCreate(['email' => 'admin@app.com'], [
            'name' => 'Admin User',
            'password' => Hash::make('password'),
            'role' => User::ROLE_ADMIN,
        ]);

        // 2. Planner/Editor User
        User::firstOrCreate(['email' => 'planner@app.com'], [
            'name' => 'Planner User',
            'password' => Hash::make('password'),
            'role' => User::ROLE_EDITOR, // Maps to isPlanner()
        ]);

        // 3. Mechanic/Author User
        User::firstOrCreate(
            ['email' => 'mechanic@app.com'],
            [
                'name' => 'Mechanic User',
                'password' => Hash::make('password'),
                'role' => User::ROLE_AUTHOR, // Maps to isMechanic()
            ]
        );

        // 4. Viewer/Regular User
        User::firstOrCreate(
            ['email' => 'viewer@app.com'],
            [
                'name' => 'Viewer User',
                'password' => Hash::make('password'),
                'role' => User::ROLE_VIEWER, // Maps to isUser()
            ]
        );
    }
}
