<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clients = Client::insert([
            [
                'name' => 'Cliente 1',
                'cpf' => '12345678900',
            ],
            [
                'name' => 'Cliente 2',
                'cpf' => '12345678900',
            ],
        ]);
    }
}
