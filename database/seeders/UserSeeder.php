<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::where('name', 'ADMIN')->first();
    $companyRole = Role::where('name', 'COMPANY')->first();

    User::create([
        'name' => 'Admin User',
        'email' => 'admin@gmail.com',
        'password' => bcrypt('password'),
        'role_id' => $adminRole->id,
    ]);

    User::create([
        'name' => 'Company User',
        'email' => 'company@gmail.com',
        'password' => bcrypt('password'),
        'role_id' => $companyRole->id,
    ]);
    }
}
