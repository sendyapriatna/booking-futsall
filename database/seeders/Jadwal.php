<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

use Faker\Factory as Faker;

class Jadwal extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $faker = Faker::create('id_ID');

        for ($i = 7; $i <= 23; $i++) {

            if ($i < 9) {
                DB::table('jadwal_tables')->insert([
                    'jadwal' => '0' . $i . ':00 - 0' . $i + 1 . ':00',
                ]);
            } else if ($i == 9) {
                DB::table('jadwal_tables')->insert([
                    'jadwal' => '0' . $i . ':00 - ' . $i + 1 . ':00',
                ]);
            } else {
                DB::table('jadwal_tables')->insert([
                    'jadwal' => $i . ':00 - ' . $i + 1 . ':00',
                ]);
            }
        }
    }
}
