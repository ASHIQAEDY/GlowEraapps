<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Add an admin user
        DB::table('users')->insert([
            'name' => 'GlowEraAdmin',
            'email' => 'Admin@gmail.com',
            'password' => Hash::make('uni10pass!!'), // Replace with a secure password
            'gender'=> 'female',
            'UserLevel' => 0, // Admin level
            'created_at' => now(),
            'updated_at' => now(),
        ]);

      
    }
}
