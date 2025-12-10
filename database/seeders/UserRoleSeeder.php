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
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@app.com',
            'password' => Hash::make('password'),
            'role' => User::ROLE_ADMIN,
        ]);

        // 2. Planner/Editor User
        User::create([
            'name' => 'Planner User',
            'email' => 'planner@app.com',
            'password' => Hash::make('password'),
            'role' => User::ROLE_EDITOR, // Maps to isPlanner()
        ]);

        // 3. Mechanic/Author User
        User::create([
            'name' => 'Mechanic User',
            'email' => 'mechanic@app.com',
            'password' => Hash::make('password'),
            'role' => User::ROLE_AUTHOR, // Maps to isMechanic()
        ]);

        // 4. Viewer/Regular User
        User::create([
            'name' => 'Viewer User',
            'email' => 'viewer@app.com',
            'password' => Hash::make('password'),
            'role' => User::ROLE_VIEWER, // Maps to isUser()
        ]);
    }
}