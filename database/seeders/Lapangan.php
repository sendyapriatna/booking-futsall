<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

use Faker\Factory as Faker;

class Lapangan extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $faker = Faker::create('id_ID');

        for ($i = 1; $i <= 4; $i++) {

            DB::table('lapangan_tables')->insert([
                'deskripsi' => $faker->text,
                'harga' => 100000,
                'panjang' => 25,
                'lebar' => 15,
                'jarijari' => 3,
                'material' => $faker->randomElement(['Rumput Sintesis', 'Semen', 'Vinyl', 'Taraflex (Polimer)', 'Parquette (Kayu)']),
                'image' => '/post-image-profile/default/lapang.jpg',
                'created_at' => Carbon::now(),
            ]);
        }
    }
}
