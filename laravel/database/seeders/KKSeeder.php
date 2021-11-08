<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class KKSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        $address = $faker->streetName;

        for ($i = 1; $i <= 10; $i++) {
            DB::table('families')->insert([
                'nomorKK' => $faker->numerify('35072###########'),
                'alamat' => 'Graha Indah A' . $i,
                'kepalaKeluarga' => $faker->name('male')
            ]);
        }
        for ($i = 1; $i <= 10; $i++) {
            DB::table('families')->insert([
                'nomorKK' => $faker->numerify('35072###########'),
                'alamat' => 'Graha Indah B' . $i,
                'kepalaKeluarga' => $faker->name('male')
            ]);
        }
        for ($i = 1; $i <= 10; $i++) {
            DB::table('families')->insert([
                'nomorKK' => $faker->numerify('35072###########'),
                'alamat' => 'Graha Indah C' . $i,
                'kepalaKeluarga' => $faker->name('male')
            ]);
        }
    }
}
