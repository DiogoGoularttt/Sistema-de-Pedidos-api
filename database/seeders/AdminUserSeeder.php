<?php

namespace Database\Seeders;

use App\Enums\UserTypeEnum;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $email = env('ADMIN_EMAIL', 'admin@admin.com');

        if (User::where('email', $email)->exists()) {
            return;
        }

        User::create([
            'name' => env('ADMIN_NAME', 'Administrador'),
            'email' => $email,
            'password' => Hash::make(env('ADMIN_PASSWORD', 'admin123')),
            'phone' => env('ADMIN_PHONE', '51999999999'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);
    }
}
