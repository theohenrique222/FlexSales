<?php

namespace Database\Seeders;

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
        $totalUsers = User::query()->count();
        
        if ($totalUsers > 0){
            return;
        }

        $user = User::create(['name' => 'Teste', 'email' => 'teste@teste.com', 'password' => '123456789']);
        
    }
}
