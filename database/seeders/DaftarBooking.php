<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

use Faker\Factory as Faker;
use Illuminate\Validation\Rules\Unique;

class DaftarBooking extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $faker = Faker::create('id_ID');

        for ($i = 1; $i <= 10; $i++) {

            DB::table('booking_tables')->insert([
                'invoice' => 'INV' . rand(100000, 999999),
                'nama' => $faker->name,
                'tanggal_booking' => Carbon::now(),
                'no_lapang' => mt_rand(1, 4),
                'total_jam' => mt_rand(0, 10),
                'total_harga' => mt_rand(200000, 300000),
                'status' =>  $faker->randomElement(['On Progress', 'Pending', 'Success']),
            ]);
        }
    }
}
