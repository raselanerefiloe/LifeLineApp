<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Syrups & Suspensions', 'image_url' => 'https://res.cloudinary.com/dygqgfmdw/image/upload/v1726570789/Panado_efmlru.png'],
            ['name' => 'Tablets & Capsules', 'image_url' => 'https://res.cloudinary.com/dygqgfmdw/image/upload/v1726570789/pills_ofcpze.jpg'],
            ['name' => 'Appliances', 'image_url' => 'https://res.cloudinary.com/dygqgfmdw/image/upload/v1726570734/certeza_nwov0b.jpg'],
            ['name' => 'ENT & Drops', 'image_url' => 'https://res.cloudinary.com/dygqgfmdw/image/upload/v1726570734/drop_znzfj2.jpg'],
            ['name' => 'Injectables', 'image_url' => 'https://res.cloudinary.com/dygqgfmdw/image/upload/v1726570788/Neurobion_o6dyuz.jpg'],
            ['name' => 'Topic Creams & Ointments', 'image_url' => 'https://res.cloudinary.com/dygqgfmdw/image/upload/v1726570735/epimax_ey5inm.png'],
            ['name' => 'Supplements', 'image_url' => 'https://res.cloudinary.com/dygqgfmdw/image/upload/v1726570734/cepacol_vqwu82.jpg'],
            ['name' => 'Traditional Herbal Products', 'image_url' => 'https://res.cloudinary.com/dygqgfmdw/image/upload/v1726570754/herbal_jtbujv.jpg'],
            ['name' => 'First Aid Supplies & Refills', 'image_url' => 'https://res.cloudinary.com/dygqgfmdw/image/upload/v1726570735/First_aid_j1k6qk.jpg'],
            ['name' => 'Homeopaths', 'image_url' => 'https://res.cloudinary.com/dygqgfmdw/image/upload/v1726570818/spevol_saonu4.jpg'],
            ['name' => 'Healthcare Equipment', 'image_url' => 'https://res.cloudinary.com/dygqgfmdw/image/upload/v1726570734/Appliance_gqlqjg.jpg'],
        ];

        DB::table('categories')->insert($categories);
    }
}
