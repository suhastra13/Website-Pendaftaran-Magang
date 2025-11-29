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
        User::updateOrCreate(
            ['email' => 'admin@magang.test'], // kunci unik admin
            [
                'name' => 'Admin DPPPA',
                'phone' => '08123456789',
                'password' => Hash::make('admin12345'), // GANTI di production
                'role' => 'admin',
            ]
        );
    }
}
