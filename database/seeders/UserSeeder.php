<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $adminRole = Role::where('name', 'admin')->first();

        User::firstOrCreate(
            ['email' => 'admin@syndicate.gov.eg'],
            [
                'name'     => 'System Administrator',
                'password' => Hash::make('password'),
                'role_id'  => $adminRole->id,
            ]
        );
    }
}