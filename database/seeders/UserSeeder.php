<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Sendy Apriatna',
            'username' => 'sendyapriatna',
            'nohp' => rand(6280000000000, 6289999999999),
            'email' => 'admin1@gmail.com',
            'password' => Hash::make('admin'),
            'role' => 'admin',
            'created_at' => Carbon::now(),
            'image' => '/post-image-profile/default/avatar-1.png'
        ]);

        DB::table('users')->insert([
            'name' => 'Jordan Brilian',
            'username' => 'jordan',
            'nohp' => rand(6280000000000, 6289999999999),
            'email' => 'admin2@gmail.com',
            'password' => Hash::make('admin'),
            'role' => 'admin',
            'created_at' => Carbon::now(),
            'image' => '/post-image-profile/default/avatar-1.png'
        ]);

        $faker = Faker::create('id_ID');

        for ($i = 1; $i <= 10; $i++) {

            DB::table('users')->insert([
                'name' => $faker->name,
                'username' => $faker->userName,
                'nohp' => rand(6280000000000, 6289999999999),
                'email' => $faker->email,
                'password' => Hash::make('12345678'),
                'role' => 'user',
                'created_at' => Carbon::now(),
                'image' => '/post-image-profile/default/avatar-1.png'
            ]);
        }
    }
}
