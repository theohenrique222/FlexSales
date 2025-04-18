<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $totalUsers = User::query()->count();

        if ($totalUsers > 0) {
            return;
        }

        $user = User::create([
            'name'      => 'Admin Teste', 
            'email'     => 'admin@teste.com', 
            'password'  => 'password',
        ]);
        $user->assignRole('admin');
    }
}
