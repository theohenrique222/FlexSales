<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = Product::insert([
            [
                'name' => 'Produto 1',
                'price' => '100',
            ],
            [
                'name' => 'Produto 2',
                'price' => '200',
            ],
        ]);
    }
}
