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
        // Só cria se ainda não existir
        if (!User::where('email', 'admin@sistema.com')->exists()) {
            User::create([
                'name' => env('ADMIN_NAME', 'Administrador'),
                'email' => env('ADMIN_EMAIL', 'admin@sistema.com'),
                'password' => Hash::make(env('ADMIN_PASSWORD', 'admin123')),
                'phone' => env('ADMIN_PHONE', '11999999999'),
                'role' => UserTypeEnum::ADMIN,
                'email_verified_at' => now(),
            ]);
        }
    }
}
