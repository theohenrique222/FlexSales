<?php

namespace Database\Seeders;

use App\Models\Seller;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $totalUsers = User::query()->count();

        if ($totalUsers > 0) {
            return;
        }

        $user = User::create([
            'name' => 'Theo Henrique', 
            'email' => 'admin@teste.com', 
            'password' => '123123123',
        ]);

       $seller = Seller::create([
            'user_id' => $user->id,
       ]);
    }
}
