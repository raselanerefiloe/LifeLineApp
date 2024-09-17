<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Realeboha Mphatsoane',
                'email' => 'realeboha.mphatsoane06@gmail.com',
                'password' => bcrypt('57658212'),
                'usertype' => 'Admin',
                'gender' => 'female'
            ],
            [
                'name' => 'Refiloe Raselane',
                'email' => 'refiloeraselane@gmail.com',
                'password' => bcrypt('53975799'),
                'usertype' => 'Admin',
                'gender' => 'male'
            ],
        ];

        DB::table('users')->insert($users);
    }
}
