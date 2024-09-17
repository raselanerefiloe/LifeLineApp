<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Realeboha Mphatsoane',
            'email' => 'realeboha.mphatsoane06@gmail.com',
            'password' => bcrypt('57658212'),
        ]);
        $this->call([
            CategoriesTableSeeder::class,
            ProductsTableSeeder::class, 
        ]);
    }
}
