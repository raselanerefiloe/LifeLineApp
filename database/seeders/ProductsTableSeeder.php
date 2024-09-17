<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Bernilin',
                'description' => 'Cough Syrup',
                'price' => 10.00,
                'quantity' => 100,
                'image_url' => 'https://res.cloudinary.com/dygqgfmdw/image/upload/v1726570735/Dry_cough_njy7m6.png',
                'manufacturer' => 'Lifetones',
                'expiry_date' => '2025-12-31',
                'size' => '100 ml',
                'inStock' => true,
            ],
            [
                'name' => 'Lifetones',
                'description' => 'AntiAcid Syrup',
                'price' => 8.00,
                'quantity' => 150,
                'image_url' => 'https://res.cloudinary.com/dygqgfmdw/image/upload/v1726570755/lifetones_e9zamt.png',
                'manufacturer' => 'Acylex',
                'expiry_date' => '2025-06-30',
                'size' => '200 ml',
                'inStock' => true,
            ],
            [
                'name' => 'Corenza',
                'description' => 'Cold and Flu Syrup',
                'price' => 9.00,
                'quantity' => 120,
                'image_url' => 'https://res.cloudinary.com/dygqgfmdw/image/upload/v1726570733/corenza-c_rbbsgx.jpg',
                'manufacturer' => 'Acylex',
                'expiry_date' => '2025-08-15',
                'size' => '200 ml',
                'inStock' => true,
            ],
            // Add the rest of the products in the same manner
            // Example:
            [
                'name' => 'Panado',
                'description' => 'Panado Headache',
                'price' => 12.00,
                'quantity' => 80,
                'image_url' => 'https://res.cloudinary.com/dygqgfmdw/image/upload/v1726570789/Panado_efmlru.png',
                'manufacturer' => 'PainReliefInc',
                'expiry_date' => '2024-11-20',
                'size' => '150 ml',
                'inStock' => true,
            ],
            // Continue adding products as needed
        ];

        DB::table('products')->insert($products);
    }
}
