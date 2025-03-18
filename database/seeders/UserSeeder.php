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
            'name'      => 'Theo Henrique', 
            'email'     => 'admin@teste.com', 
            'password'  => 'password',
        ]);

       $seller = Seller::create([
            'user_id'   => $user->id,
       ]);
    }
}
